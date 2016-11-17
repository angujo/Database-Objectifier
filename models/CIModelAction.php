<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 16-Nov-16
 * Time: 7:50 PM
 */

namespace Database;


class CIModelAction
{
	public static $_DB;
	public static $_ACTION_USER;

	public static function getOne($table)
	{
		$q = self::$_DB->get($table, 1);
		if (!$q->num_rows()) return [];
		return $q->row_array();
	}

	public static function getAll($table, $limit = 100, $offset = 0)
	{
		$q = self::$_DB->get($table, (int)$limit, (int)$offset);
		if (!$q->num_rows()) return [];
		return $q->result_array();
	}

	public static function getObjects($table, array $dbConditions, $className, $limit = 100, $offset = 0)
	{
		if (!class_exists($className)) return [];
		foreach ($dbConditions as $dbCondition) {
			if (2 > count($dbCondition)) continue;
			$method = $dbCondition[0];
			$args   = $dbCondition[1];
			if (!method_exists(self::$_DB, $method) || !is_callable([self::$_DB, $method])) continue;
			call_user_func_array([self::$_DB, $method], is_array($args) ? $args : [$args]);
		}
		if (!$rows = self::getAll($table, $limit, $offset)) return [];
		return array_map(function ($row) use ($className) {
			return (new $className($row));
		}, $rows);
	}

	public static function countObjects($table, array $dbConditions)
	{
		foreach ($dbConditions as $dbCondition) {
			if (2 > count($dbCondition)) continue;
			$method = $dbCondition[0];
			$args   = $dbCondition[1];
			if (!method_exists(self::$_DB, $method) || !is_callable([self::$_DB, $method])) continue;
			call_user_func_array([self::$_DB, $method], is_array($args) ? $args : [$args]);
		}
		if (!$row = self::getOne($table)) return 0;
		return isset($row['_c']) ? $row['_c'] : 0;
	}

	public static function delete($tableName)
	{
		self::$_DB->delete($tableName);
		if ($aff = self::$_DB->affected_rows()) {
			self::actionRegister($tableName, 'delete', 0);
		}
		return $aff;
	}

	public static function save($tableName, array $data)
	{
		if (isset($data['id']) && trim($data['id']) && is_numeric($data['id'])) {
			$id = $data['id'];
			unset($data['id']);
			return self::update($tableName, $id, $data);
		}
		return self::insert($tableName, $data);
	}

	private static function insert($tableName, array $data)
	{
		unset($data['id']);
		self::$_DB->insert($tableName, $data);
		$id  = self::$_DB->insert_id();
		$res = (bool)$id;
		if ($res) {
			self::actionRegister($tableName, 'insert', $id);
		}
		return $res;
	}

	private static function update($tableName, $id, array $data)
	{
		self::$_DB->where('id', $id);
		self::$_DB->update($tableName, $data);
		$res = (bool)self::$_DB->affected_rows();
		if ($res) {
			self::actionRegister($tableName, 'update', $id);
		}
		return $res;
	}

	public static function __callStatic($name, $arguments)
	{
		if (method_exists(self::$_DB, $name) && is_callable([self::$_DB, $name])) {
			$res = call_user_func_array([self::$_DB, $name], $arguments);
			if (!is_object($res)) return $res;
		}
		return new static();
	}

	private static function actionRegister($tableName, $action, $id)
	{
		$table = preg_replace('/[^a-zA-Z0-9_]/', '', strtolower(self::$_DB->database . '_events'));
		if (!self::$_DB->table_exists($table)) {
			$q = 'CREATE TABLE `' . $table .
			     '`( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `row_id` INT DEFAULT 0, `action` VARCHAR(200), `action_user` INT DEFAULT 0, `table_name` VARCHAR(250), `event_date` DATETIME, PRIMARY KEY (`id`) );';
			if (!self::$_DB->simple_query($q)) {
				return;
			}
		}
		self::$_DB->insert($table, array('action'     => $action, 'action_user' => (int)self::$_ACTION_USER, 'table_name' => $tableName,
		                                 'event_date' => date('Y-m-d H:i:s'), 'row_id' => (int)@$id));
	}
}