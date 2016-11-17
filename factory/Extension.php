<?php

/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 20-Oct-16
 * Time: 7:26 AM
 */
class Extension
{
	/**
	 * @var Table
	 */
	private $table;
	/**
	 * @var string
	 */
	private $objectName;
	/**
	 * @var array
	 */
	private $constructorArgs;
	/**
	 * @var string
	 */
	private $extensionName;

	private $tableAliases = array();

	private $functions = array();

	function __construct(Table $table, $constArgs)
	{
		$this->table           = $table;
		$this->objectName      = $table->model;
		$this->constructorArgs = $constArgs;
		$this->extensionName   = $this->objectName . 'Ext';
	}

	private function startExtension()
	{
		$inherits = [];
		$fs       = $this->table->getFields();
		foreach ($fs as $f) {
			$inherits[] = ' * @property ' . $f->commentDataTypeName . ' $' . $f->name;
			$inherits[] =
				' * @method $this set' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $f->name))) . '(' . $f->commentDataTypeName .
				'$' . $f->name . ')';
			$inherits[] =
				' * @method ' . $f->commentDataTypeName . ' get' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $f->name))) . '()';
		}
		$dir = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName();
		if (!file_exists($dir) || !is_dir($dir)) {
			if (!mkdir($dir, 0755, TRUE)) {
				$this->startExtension();
			}
		}
		$dir .= DIRECTORY_SEPARATOR;
		if (file_exists($dir . $this->extensionName . '.php')) {
			unlink($dir . $this->extensionName . '.php');
		}
		$str = '<?php ' . PHP_EOL . PHP_EOL . 'namespace Database\\' . Configuration::dbNamespace() . ';' . PHP_EOL .
		       'use Database\\DbActive;' . PHP_EOL . '/**' . PHP_EOL .
		       implode(PHP_EOL, $inherits) . PHP_EOL . ' */' . PHP_EOL .
		       'class ' . $this->extensionName . ' extends DbActive {' . PHP_EOL . PHP_EOL . Configuration::TAB .
		       'protected static $MODEL_NAME = \'Database\\' . Configuration::dbNamespace() . '\\' . $this->objectName . '\';' . PHP_EOL .
		       PHP_EOL . Configuration::TAB .
		       'CONST TABLE_NAME = \'' . $this->table->name . '\';' . PHP_EOL . PHP_EOL;
		file_put_contents($dir . $this->extensionName . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
	}

	private function closeExtension()
	{
		$str = '}' . PHP_EOL . PHP_EOL .
		       '/*' . PHP_EOL .
		       ' * --------------------------DON\'T REMOVE THIS------------------------- ' . PHP_EOL .
		       ' * End of Class ' . $this->extensionName . PHP_EOL .
		       ' * DbObjectofier developed by angujo ' . PHP_EOL .
		       ' * Tweet at @angujomondi ' . PHP_EOL .
		       ' * Generated: ' . date('Y-m-d H:i:s T') . PHP_EOL .
		       ' */' . PHP_EOL;
		$this->editExtension($str);
	}

	private function editExtension($string)
	{
		$dir = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName() . DIRECTORY_SEPARATOR;
		if (!file_exists($dir . $this->extensionName . '.php')) {
			$this->startExtension();
		}
		file_put_contents($dir . $this->extensionName . '.php', $string . PHP_EOL, FILE_APPEND | LOCK_EX);
	}

	private function createConstructor()
	{
		$str = Configuration::TAB . 'function __construct($conditions=FALSE){' . PHP_EOL .
		       Configuration::TAB(2) . 'parent::__construct($conditions);' .
		       PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
		$this->editExtension($str);
	}

	/**
	 * Method to ensure table aliases remain consistent for any given extension.
	 *
	 * @param $tableName string
	 *
	 * @return string
	 */
	private function alias($tableName)
	{
		if (!isset($this->tableAliases[$tableName])) {
			$this->tableAliases[$tableName] = 'tbl' . count($this->tableAliases);
		}
		return $this->tableAliases[$tableName];
	}

	private function createGet($reference, $joins = array())
	{
		$tblModel = ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->table)));
		if (isset($this->functions[$tblModel])) return;
		$this->functions[$tblModel] = TRUE;
		if (empty($joins)) {
			$joins[] =
				'$details[]=[\'where\',[\'' . $this->alias($reference->table) . '.' . $reference->column . '\', (int)$this->' .
				$reference->referenced_column . ']];';
		} else {
			$joins[$reference->referenced_table] =
				'$details[]=[\'join\',[\'' . $reference->referenced_table . ' ' . $this->alias($reference->referenced_table) . '\', \'' .
				$this->alias($reference->referenced_table) . '.' . $reference->referenced_column . ' = ' . $this->alias($reference->table) .
				'.' . $reference->column . '\']];';
		}
		$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
		       '@param $' . $reference->referenced_column . PHP_EOL . Configuration::TAB . ' * ' .
		       '@param int $limit' . PHP_EOL . Configuration::TAB . ' * ' .
		       '@param int $offset' . PHP_EOL . Configuration::TAB . ' * ' .
		       '@return ' . $tblModel . '[]' . PHP_EOL . Configuration::TAB . ' */' . PHP_EOL . Configuration::TAB .
		       'function get' . $tblModel . '($limit = 100, $offset = 0){' .
		       PHP_EOL . Configuration::TAB(2) . 'if(!$this->'. $reference->referenced_column.') return [];' .
		       PHP_EOL . Configuration::TAB(2) . '$limit = (int)$limit;' .
		       PHP_EOL . Configuration::TAB(2) . '$offset = (int)$offset;' .
		       PHP_EOL . Configuration::TAB(2) . '$details = [];' .
		       PHP_EOL . Configuration::TAB(2) . implode(PHP_EOL . Configuration::TAB(2), array_reverse($joins)) . PHP_EOL .
		       Configuration::TAB(2) . '$details[]=[\'select\',[\'' . $this->alias($reference->table) . '.*\']];' .
		       PHP_EOL . Configuration::TAB(2) . 'return $this->getClasses($details, \'' . $reference->table . ' ' .
		       $this->alias($reference->table) . '\', \'\Database\\' . Configuration::dbNamespace() . '\\' . $tblModel .
		       '\', $limit, $offset);' . PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
		$str = str_ireplace($this->alias($reference->table), 't_tbl', $str);
		$this->editExtension($str);
		if (@$reference->children && is_array($reference->children)) {
			foreach ($reference->children as $childRef) {
				$this->createGet($childRef, $joins);
			}
		}
	}

	private function createCount($reference, &$joins = array())
	{
		$tblModel = ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->table)));
		if (isset($this->functions['cnt' . $tblModel])) return;
		$this->functions['cnt' . $tblModel] = TRUE;
		if (empty($joins)) {
			$joins[] =
				'$this->DB->where(\'' . $this->alias($reference->table) . '.' . $reference->column . '\', (int)$' .
				$reference->referenced_column . ');';
		} else {
			$joins[$reference->referenced_table] =
				'$this->DB->join(\'' . $reference->referenced_table . ' ' . $this->alias($reference->referenced_table) . '\', \'' .
				$this->alias($reference->referenced_table) . '.' . $reference->referenced_column . ' = ' . $this->alias($reference->table) .
				'.' . $reference->column . '\');';
		}
		$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
		       '@param $' . $reference->referenced_column . PHP_EOL . Configuration::TAB . ' * ' .
		       '@return int' . PHP_EOL . Configuration::TAB . ' */' . PHP_EOL . Configuration::TAB .
		       'function count' . $tblModel . '($' . $reference->referenced_column . '){' .
		       PHP_EOL . Configuration::TAB(2) . implode(PHP_EOL . Configuration::TAB(2), array_reverse($joins)) . PHP_EOL .
		       Configuration::TAB(2) .
		       'return (int)@$this->DB->select(\'COUNT(DISTINCT ' . $this->alias($reference->table) . '.id) _c\')->get(\'' . $reference->table .
		       ' ' .
		       $this->alias($reference->table) . '\')->row()->_c;' . PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
		$this->editExtension($str);
		if (@$reference->children && is_array($reference->children)) {
			foreach ($reference->children as $childRef) {
				$this->createCount($childRef, $joins);
			}
		}
	}

	function generate($fields)
	{
		if (empty($fields)) return;
		$this->startExtension();
		$this->createConstructor();
		foreach ($fields as $field) {
			if (!trim($field->table)) continue;
			$this->createGet($field);
			$this->createCount($field);
		}
		$this->closeExtension();
	}
}