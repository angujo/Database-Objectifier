<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model
 *
 * @author bangujo
 */
class Model
{

	private $table;

	public function __construct(Table $table)
	{
		$this->table = $table;
	}

	function generate()
	{
		$this->startModel();
		$this->createProperties();
		$this->createConstructor();
		$this->createSetters();
		$this->createGetters();
		$this->closeModel();
	}

	private function createProperties()
	{
		foreach ($this->table->getFields() as $field) {
			/* @var $field Tablefield */
			$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
			$str .= $field->label . PHP_EOL . Configuration::TAB . ' * ';
			if ($field->required) {
				$str .= '(Required)' . PHP_EOL . Configuration::TAB . ' * ';
			}
			$str .= $field->dataType . PHP_EOL . Configuration::TAB . ' * ';
			$str .= '@var ' . $field->commentDataTypeName;
			$str .= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
			$str .= Configuration::TAB . 'public $' . $field->name . ' = ' . $field->varDefaultValue . ';' . PHP_EOL;
			$this->editModel($str);
		}
	}

	private function createSetters()
	{
		$fields = $this->table->getFields();
		foreach ($fields as $field) {
			/* @var $field Tablefield */
			$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
			$str .= '@param ' . $field->commentDataTypeName . ' $' . $field->name;
			$str .= PHP_EOL . Configuration::TAB . ' * ';
			$str .= '@return $this';
			$str .= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
			$str .= Configuration::TAB . 'public function set' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(' .
			        $field->argDataTypeName . '$' . $field->name . '){' . PHP_EOL;
			$str .= Configuration::TAB(2) . '$this->' . $field->name . ' = ' . $field->constDefaultValue . ';' . PHP_EOL;
			$str .= Configuration::TAB(2) . 'return $this;' . PHP_EOL;
			$str .= Configuration::TAB . '}' . PHP_EOL;
			$this->editModel($str);
		}
	}

	private function createGetters()
	{
		foreach ($this->table->getFields() as $field) {
			/* @var $field Tablefield */
			$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
			$str .= '@return ' . $field->commentDataTypeName;
			$str .= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
			$str .= Configuration::TAB . 'public function get' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(){' .
			        PHP_EOL;
			$str .= Configuration::TAB(2) . 'return $this->' . $field->name . ';' . PHP_EOL;
			$str .= Configuration::TAB . '}' . PHP_EOL;
			$this->editModel($str);
		}
	}

	private function createConstructor()
	{
		$str =			Configuration::TAB . 'function __construct($conditions=FALSE){' . PHP_EOL . Configuration::TAB(2) .
			'parent::__construct($conditions);' . PHP_EOL .
			Configuration::TAB . '}' . PHP_EOL;
		$this->editModel($str);
	}

	private function startModel()
	{
		$dir     = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName();
		$details = [];
		$fields  = $this->table->getFields();
		foreach ($fields as $field) {
			$details[] =
				'\'' . $field->name . '\' => [\'type\'=>\'' . trim($field->commentDataTypeName) . '\', \'label\' => \'' . $field->label .
				'\', \'unique\' => ' . strtoupper(var_export($field->unique, TRUE)) .
				', \'required\' => ' . strtoupper(var_export($field->required, TRUE)) . ']';
		}
		if (!file_exists($dir) || !is_dir($dir)) {
			if (!mkdir($dir, 0755, TRUE)) {
				$this->startModel();
			}
		}
		$dir .= DIRECTORY_SEPARATOR;
		if (file_exists($dir . $this->table->model . '.php')) {
			unlink($dir . $this->table->model . '.php');
		}
		$str = '<?php ' . PHP_EOL . PHP_EOL . 'namespace Database\\' . Configuration::dbNamespace() . ';' . PHP_EOL .
		       PHP_EOL . 'use Database;' . PHP_EOL .
		       PHP_EOL . 'class ' . $this->table->model . ' extends Database\DbActive{' . PHP_EOL . PHP_EOL;
		$str .= Configuration::TAB . 'CONST TABLE_NAME = \'' . $this->table->name . '\';' . PHP_EOL;
		$str .= Configuration::TAB . 'protected static $DETAILS = [' . implode(', ', $details) . '];' . PHP_EOL;
		file_put_contents($dir . $this->table->model . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
	}

	private function closeModel()
	{
		$str = '}' . PHP_EOL . PHP_EOL .
		       '/*' . PHP_EOL .
		       ' * --------------------------DON\'T REMOVE THIS------------------------- ' . PHP_EOL .
		       ' * End of Class ' . $this->table->model . PHP_EOL .
		       ' * DbObjectofier developed by angujo ' . PHP_EOL .
		       ' * Tweet at @angujomondi ' . PHP_EOL .
		       ' * Generated: ' . date('Y-m-d H:i:s T') . PHP_EOL .
		       ' */' . PHP_EOL;
		$this->editModel($str);
	}

	private function editModel($string)
	{
		$dir = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName() . DIRECTORY_SEPARATOR;
		if (!file_exists($dir . $this->table->model . '.php')) {
			$this->startModel();
		}
		file_put_contents($dir . $this->table->model . '.php', $string . PHP_EOL, FILE_APPEND | LOCK_EX);
	}

}
