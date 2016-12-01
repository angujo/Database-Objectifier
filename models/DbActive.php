<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 26-Oct-16
 * Time: 6:47 PM
 */

namespace Database;

/**
 * Class DbActive
 *
 * @package Database Yes
 *
 * @method $this where(string $column, string $value = NULL);
 * @method $this where_in(string $column, $value = []);
 * @method $this where_not_in(string $column, $value = []);
 * @method $this set(string $column, $value = NULL);
 * @method $this groupStart();
 * @method $this groupEnd();
 * @method $this order_by(string $column, string $order);
 * @method bool delete();
 * @method $this save(boolean $returnInstance = FALSE);
 * @method string lastQuery();
 * @method $this getAll(array $conditions, int $limitCount = 30, $offset = 0, array $search = []);
 */
class DbActive
{
	CONST TABLE_NAME = '';
	/** @var  $this */
	private static $ME;
	
	public function __construct($conditions = NULL)
	{
		if (NULL === $conditions) return;
		if (is_array($conditions)) {
			$this->init($conditions);
		} elseif ($conditions) {
			$this->init(CIModelAction::where('id', (int)$conditions)->getOne(static::TABLE_NAME));
		}
	}
	
	/**
	 * @param array $details
	 * @param bool  $update
	 *
	 * @return $this
	 */
	public function init(array $details, $update = FALSE)
	{
		if (FALSE !== $update) {
			foreach ($this as $key => $val) {
				$this->{$key} = NULL;
			}
		}
		$vars = array_intersect_key($details, get_object_vars($this));
		foreach ($vars as $property => $val) {
			$this->{$property} = $val;
		}
		return $this;
	}
	
	function __call($name, $arguments)
	{
		$sub = substr($name, 0, 3);
		if (in_array($sub, ['set', 'get']) && 3 < strlen($name)) {
			foreach ($this as $prop => $val) {
				$func = $sub . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $prop)));
				if ($name == $func) {
					if ('get' == $sub) {
						return $val;
					}
					if ('set' == $sub) {
						if (1 <= count($arguments)) {
							$this->{$prop} = $arguments[0];
						}
						return $this;
					}
				}
			}
		}
		if (method_exists('Database\CIModelAction', $name) || is_callable(['Database\CIModelAction', $name])) {
			if ('save' == $name) {
				$id = 0;
				CIModelAction::save(static::TABLE_NAME, get_object_vars($this), $id);
				if ($id && !$this->id) $this->id = $id;
				return $id;
			}
			if ('delete' == $name && CIModelAction::where('id', $this->id)->delete(static::TABLE_NAME)) {
				return NULL;
			}
			$ciR = forward_static_call_array(['Database\CIModelAction', $name], $arguments);
			if (!is_object($ciR)) return $ciR;
			return $this;
		}
		return NULL;
	}
	
	/**
	 * @param $conditions
	 * @param $table
	 *
	 * @return int
	 */
	protected function countClasses($conditions, $table)
	{
		return CIModelAction::countObjects($table, $conditions);
	}
	
	protected function getClasses($conditions, $table, $class, $limit, $offSet)
	{
		return CIModelAction::getObjects($table, $conditions, $class, $limit, $offSet);
	}
	
	/**
	 * @param $condition
	 *
	 * @return null|static
	 */
	public static function findOne($condition)
	{
		self::$ME = new static();
		if (($args = func_get_args()) && count($args)) {
			if (1 == count($args)) {
				if (is_array($args[0])) {
					CIModelAction::where($args[0]);
				} else {
					CIModelAction::where('id', $args[0]);
				}
			} else call_user_func_array(['Database\CIModelAction', 'where'], $args);
			self::$ME->init(CIModelAction::getOne(static::TABLE_NAME));
		}
		return self::$ME->id ? self::$ME : NULL;
	}
	
	/**
	 * @return static[]
	 */
	public static function findAll()
	{
		self::$ME = new static();
		if (($args = func_get_args()) && count($args)) {
			if (1 == count($args)) {
				if (is_array($args[0])) {
					CIModelAction::where($args[0]);
				} else {
					self::$ME->where('id', $args[0]);
				}
			} else call_user_func_array([self::$ME, 'where'], $args);
		}
		$className = get_class(self::$ME);
		if (!$rows = CIModelAction::getAll(static::TABLE_NAME, 9999, 0)) return [];
		return array_map(function ($row) use ($className) {
			return (new $className($row));
		}, $rows);
	}
	
	/**
	 * @return static
	 */
	public static function find()
	{
		self::$ME = new static();
		return self::$ME;
	}
	
	/**
	 * @return static
	 */
	public static function one()
	{
		if (!self::$ME) return NULL;
		self::$ME->init(CIModelAction::getOne(static::TABLE_NAME));
		return self::$ME;
	}
	
	/**
	 * @return int
	 */
	public static function count()
	{
		if (!self::$ME) return NULL;
		return CIModelAction::getCount(static::TABLE_NAME);
	}
	
	/**
	 * @return bool|null
	 */
	public function exists()
	{
		if (!self::$ME) return NULL;
		return 0 < CIModelAction::getCount(static::TABLE_NAME);
	}
	
	/**
	 * @param null $limit
	 * @param int  $start
	 *
	 * @return static[]
	 */
	public static function all($limit = NULL, $start = 0)
	{
		if (!self::$ME) return [];
		$className = get_class(self::$ME);
		$limit     = (int)!is_numeric($limit) ? 9999 : $limit;
		if (!$rows = CIModelAction::getAll(static::TABLE_NAME, $limit, (int)$start)) return [];
		return array_map(function ($row) use ($className) {
			return (new $className($row));
		}, $rows);
	}
	
	public static function __callStatic($name, $arguments)
	{
		var_dump(func_get_args(), __FILE__);
	}
	
	/**
	 * @param $id
	 *
	 * @return static
	 */
	public static function setPK($id)
	{
		self::$ME = new static();
		return self::$ME->setId($id);
	}
	
	/**
	 * @param array $updates
	 *
	 * @return bool
	 */
	public static function updateAll(array $updates = [])
	{
		return CIModelAction::inUpdate(static::TABLE_NAME, $updates);
	}
}