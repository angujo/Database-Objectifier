<?php
namespace Database;

require_once 'DbExtend.php';

/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 19-Oct-16
 * Time: 7:27 PM
 *
 * @method $this whereTarget(string $column, string $value);
 * @method $this wherePrimary(string $column, string $value);
 * @method $this orderBy(string $column, string $order);
 */
class ModelAction extends \Dbobjectifier
{
	CONST TABLE_NAME = '';
	protected static $DETAILS  = [];
	public           $id       = FALSE;
	private          $DBExtend = NULL;

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
		$this->checkValues();
		if (!DBOStatus::$OK) return FALSE;
		if ($this->id) {
			return $this->update();
		} else {
			unset($this->id);
			return $this->insert();
		}
	}

	private function checkValues()
	{
		DBOStatus::$OK = TRUE;
		$required      = array();
		$unique        = array();
		foreach (static::$DETAILS as $field => $detail) {
			if ($detail['required'] && (!isset($this->{$field}) || 0 >= strlen($this->{$field}))) {
				$required[] = $detail['label'];
			}
			if ($detail['unique']) {
				$unique[$field] = @$this->{$field};
			}
		}
		if ($required) {
			DBOStatus::$OK     = FALSE;
			DBOStatus::$ERROR  = 'The following field(s) is/are <b>REQUIRED</b>:<br/><ol>' . implode('', array_map(function ($f) {
					return '<li>' . $f . '</li>';
				}, $required)) . '</ol>';
			DBOStatus::$RESULT = NULL;
		}
		if ($unique) {
			$this->DB->group_start();
			foreach ($unique as $col => $item) {
				$this->DB->or_where($col, $item);
			}
			$this->DB->group_end()->where('id !=', (int)@$this->id);
			if ($this->DB->count_all_results(static::TABLE_NAME)) {
				DBOStatus::$OK     = FALSE;
				DBOStatus::$ERROR  = 'Your entries already exist!';
				DBOStatus::$RESULT = NULL;
			}
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

	private function insert()
	{
		$this->DB->insert(static::TABLE_NAME, $this);
		$this->id = $this->DB->insert_id();
		$res      = (bool)$this->id;
		if ($res) {
			$this->actionRegister('insert');
		}
		return $res;
	}

	private function update()
	{
		$id = $this->id;
		$this->DB->where('id', $id);
		unset($this->id);
		$this->DB->update(static::TABLE_NAME, $this);
		$this->id = $id;
		$res      = (bool)$this->DB->affected_rows();
		$this->actionRegister($res ? 'update' : 'update_attempt');
		return $res;
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
		if (!$this->DBExtend) {
			$this->DBExtend = new DbExtend($this->DB);
		}
		if (method_exists($this->DBExtend, $name)) {
			if (is_callable(array($this->DBExtend, $name), TRUE)) {
				call_user_func_array(array($this->DBExtend, $name), $arguments);
				return $this;
			}
		}
		throw new \Exception('Invalid call to method : ' . $name . '! METHOD DOES NOT EXIST!');
	}

	function lastQuery()
	{
		return $this->DB->last_query();
	}

	private function actionRegister($action)
	{
		$table = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower($this->DB->database . '_events'));
		if (!$this->DB->table_exists($table)) {
			$q = 'CREATE TABLE `' . $table .
			     '`( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `row_id` INT DEFAULT 0, `action` VARCHAR(200), `action_user` INT DEFAULT 0, `table_name` VARCHAR(250), `event_date` DATETIME, PRIMARY KEY (`id`) );';
			if (!$this->DB->simple_query($q)) {
				return;
			}
		}
		$this->DB->insert($table, array('action'     => $action, 'action_user' => (int)self::$ACTION_USER, 'table_name' => static::TABLE_NAME,
		                                'event_date' => date('Y-m-d H:i:s'), 'row_id' => (int)@$this->id));
	}
}

class DBOStatus
{
	static $OK    = TRUE;
	static $ERROR = '';
	static $RESULT;
}

$dirs = glob(dirname(__FILE__) . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
foreach ($dirs as $dir) {
	$files = glob($dir . DIRECTORY_SEPARATOR . '*.{php}', GLOB_BRACE);
	foreach ($files as $file) {
		require_once $file;
	}
}