<?php
namespace Database;

/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 19-Oct-16
 * Time: 7:27 PM
 */
class ModelAction extends \Dbobjectifier
{
	//protected $DB = NULL;
	CONST TABLE_NAME = '';
	public $id = FALSE;

	function __construct()
	{
		parent::__construct();
		$object = get_class($this);
		if (!static::TABLE_NAME) {
			throw new \Exception($object . ' IS MISSING TABLE!');
		}
		if (!isset($this->id) || FALSE === $this->id) {
			throw new \Exception($object . ' IS MISSING COLUMN [ID]!');
		}
		$this->id = (int)$this->id;
	}

	function save()
	{
		$table = static::TABLE_NAME;
		if ($this->id) {
			return $this->update($table);
		} else {
			unset($this->id);
			return $this->insert($table);
		}
	}

	/**
	 * @return bool
	 */
	function delete()
	{
		$this->DB->where('id', $this->id)->delete(static::TABLE_NAME);
		return (bool)$this->DB->affected_rows();
	}

	/**
	 * @param $conditions
	 *
	 * @return $this
	 */
	function getOne($conditions)
	{
		if (is_array($conditions)) {
			$conditions = array_filter($conditions, function ($k) {
				return strlen($k) > 0 && !ctype_digit(substr($k, 0, 1));
			}, ARRAY_FILTER_USE_KEY);
			$found      = FALSE;
			foreach ($conditions as $column => $value) {
				if (isset($this->{$column})) {
					$found = TRUE;
					$this->DB->where($column, $value);
				}
			}
			if (!$conditions || !$found) return NULL;
		} else {
			$this->DB->where('id', (int)$conditions);
		}
		$q = $this->DB->get(static::TABLE_NAME, 1);
		if (!$q->num_rows()) return NULL;
		return $q->custom_row_object(0, get_class($this));
	}

	/**
	 * @param array $conditions
	 * @param int   $limitCount
	 * @param int   $offset
	 * @param array $search
	 *
	 * @return $this[]
	 */
	function getAll(array $conditions, $limitCount = 30, $offset = 0, array $search = array())
	{
		if (is_array($conditions)) {
			$conditions = array_filter($conditions, function ($k) {
				$k = trim($k);
				return strlen($k) > 0 && !ctype_digit(substr($k, 0, 1));
			}, ARRAY_FILTER_USE_KEY);
			$found      = FALSE;
			foreach ($conditions as $column => $value) {
				if (isset($this->{$column})) {
					$found = TRUE;
					$this->DB->where($column, $value);
				}
			}
			if (!$conditions || !$found) return NULL;
		}
		if (is_array($search) && 1 < count($search) && !is_array($search[0]) && is_array($search[1])) {
			$this->DB->group_start();
			foreach ($search[1] as $item) {
				$this->DB->or_like($item, $search[0]);
			}
			$this->DB->group_end();
		}
		$q = $this->DB->get(static::TABLE_NAME, (int)$limitCount, (int)$offset);
		if (!$q->num_rows()) return NULL;
		return $q->custom_result_object(get_class($this));
	}

	private function insert($table)
	{
		$this->DB->insert($table, $this);
		$this->id = $this->DB->insert_id();
		return (bool)$this->id;
	}

	private function update($table)
	{
		$id = $this->id;
		$this->DB->where('id', $id);
		unset($this->id);
		$this->DB->update($table, $this);
		$this->id = $id;
		return (bool)$this->DB->affected_rows();
	}

	function init(array $data)
	{
		foreach ($data as $column => $value) {
			if (!trim($column)) continue;
			if (isset($this->{$column})) $this->{$column} = $value;
		}
		return $this;
	}

	function __call($name, $arguments)
	{
		if (method_exists($this, $name)) {
			return call_user_func_array(array($this, $name), $arguments);
		}
		if (isset($this->{$name})) return $this->{$name};
		throw new \Exception('Invalid call to method : ' . $name . '! METHOD DOES NOT EXIST!');
	}

	function lastQuery()
	{
		return $this->DB->last_query();
	}
}

$dirs = glob(dirname(__FILE__) . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
foreach ($dirs as $dir) {
	$files = glob($dir . DIRECTORY_SEPARATOR . '*.{php}', GLOB_BRACE);
	foreach ($files as $file) {
		require_once $file;
	}
}