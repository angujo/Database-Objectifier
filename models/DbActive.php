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
	private static   $MODEL_ACTION;
	private static   $MODEL;
	protected static $MODEL_NAME;
	private static   $DB_EXTEND;
	CONST TABLE_NAME = '';

	public function __construct($conditions = FALSE)
	{
	}

	function init(array $details)
	{
		$this->sLoad();
		if ($this::$MODEL) {
			$props = get_class_vars(get_class($this::$MODEL));
			foreach ($props as $prop) {
				if (isset($details[$prop])) {
					$this::$MODEL->{$prop} = $details[$prop];
				}
			}
		} else {
			$props = get_class_vars(get_class($this));
			foreach ($props as $prop) {
				if (isset($details[$prop])) {
					$this->{$prop} = $details[$prop];
				}
			}
		}
	}

	private function sLoad()
	{
		if (static::$MODEL_NAME && class_exists(static::$MODEL_NAME)) {
			self::$MODEL = new static::$MODEL_NAME();
		}
		if (!self::$MODEL_ACTION) {
			self::$MODEL        = self::$MODEL ?: $this;
			self::$MODEL_ACTION = new ModelAction(self::$MODEL);
		}
		if (!self::$DB_EXTEND) {
			self::$DB_EXTEND = new DbExtend(self::$MODEL_ACTION->DB);
		}
	}

	function __call($name, $arguments)
	{
		$this->sLoad();
		if (method_exists(self::$DB_EXTEND, $name)) {
			call_user_func_array(array(self::$DB_EXTEND, $name), $arguments);
			return $this;
		}
		if (self::$MODEL && method_exists(self::$MODEL, $name)) {
			return call_user_func_array(array(self::$MODEL, $name), $arguments);
		}
		if (!method_exists(self::$MODEL_ACTION, $name) || !is_callable(array(self::$MODEL_ACTION, $name))) return NULL;
		return call_user_func_array(array(self::$MODEL_ACTION, $name), $arguments);
	}

	function __get($name)
	{
		$this->sLoad();
		if (isset(self::$MODEL->{$name})) return self::$MODEL->{$name};
		if (isset(self::$MODEL_ACTION->{$name})) return self::$MODEL_ACTION->{$name};
		return NULL;
	}
}