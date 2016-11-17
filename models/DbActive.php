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
 * @method $this where(string $column, string $value);
 * @method $this whereIn(string $column, array $value);
 * @method $this groupStart();
 * @method $this groupEnd();
 * @method $this orderBy(string $column, string $order);
 * @method bool delete();
 * @method $this save(boolean $returnInstance = FALSE);
 * @method string lastQuery();
 * @method $this getAll(array $conditions, int $limitCount = 30, $offset = 0, array $search = array());
 */
class DbActive
{
	CONST TABLE_NAME = '';

	public function __construct($conditions = NULL)
	{
		if (NULL === $conditions) return;
		if (is_array($conditions)) {
			$this->init($conditions);
		} else {
			$this->init(CIModelAction::where('id', (int)$conditions)->getOne(static::TABLE_NAME));
		}
	}

	public function init(array $details)
	{
		foreach ($this as $key => $val) {
			$this->{$key} = NULL;
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
		if (in_array($sub, ['set', 'get'])) {
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
		if (method_exists('Database\CIModelAction', $name)) {
			if ('save' == $name) {
				$id = CIModelAction::save(static::TABLE_NAME, get_object_vars($this));
				if ($id && !$this->id) $this->id = $id;
				return $id;
			}
			if ('delete' == $name && CIModelAction::where('id', $this->id)->delete(static::TABLE_NAME)) {
				return NULL;
			}
			forward_static_call_array(['Database\CIModelAction', $name], $arguments);
			return $this;
		}
		return NULL;
	}

	protected function countClasses($conditions, $table)
	{
		return CIModelAction::countObjects($table, $conditions);
	}

	protected function getClasses($conditions, $table, $class, $limit, $offSet)
	{
		return CIModelAction::getObjects($table, $conditions, $class, $limit, $offSet);
	}
}