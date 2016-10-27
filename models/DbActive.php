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
 * @method $this whereTarget(string $column, string $value);
 * @method $this wherePrimary(string $column, string $value);
 * @method $this orderBy(string $column, string $order);
 * @method $this getOne($conditions);
 * @method bool delete($conditions);
 * @method $this save();
 * @method string lastQuery();
 * @method $this getAll(array $conditions, $limitCount = 30, $offset = 0, array $search = array());
 */
class DbActive
{
	/**
	 * @var ModelAction
	 */
	private static $MODEL_ACTION;
	private static $MODEL;
	private static $MODEL_NAME;
	private static $DB_EXTEND;
	CONST TABLE_NAME = '';

	private function sLoad()
	{
		if (!$this::$MODEL_ACTION) {
			$this::$MODEL_ACTION = new ModelAction();
		}
		if (!$this::$DB_EXTEND) {
			$this::$DB_EXTEND = new DbExtend($this::$MODEL_ACTION->getDB());
		}
		if (!static::$MODEL_NAME || !class_exists(static::$MODEL_NAME)) {
			return NULL;
		}
		if (!static::$MODEL) {
			static::$MODEL = new static::$MODEL_NAME();
		}
		return TRUE;
	}

	function __call($name, $arguments)
	{
		$this->sLoad();
		if (method_exists($this::$DB_EXTEND, $name)) {
			call_user_func_array(array($this::$DB_EXTEND, $name), $arguments);
			return $this;
		}
		if (!method_exists($this::$MODEL_ACTION, $name) || !is_callable(array($this::$MODEL_ACTION, $name))) return NULL;
		return call_user_func_array(array($this::$MODEL_ACTION, $name), $arguments);
	}

	function __get($name)
	{
		if (!$this->sLoad()) return NULL;

		if (isset(static::$MODEL->{$name})) return static::$MODEL->{$name};
		return NULL;
	}
}