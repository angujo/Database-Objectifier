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

	private $functions = array();

	function __construct(Table $table, $constArgs)
	{
		$this->objectName      = $table->model;
		$this->constructorArgs = $constArgs;
		$this->extensionName   = $this->objectName . 'Ext';
	}

	private function startExtension()
	{
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
		       // PHP_EOL . 'use Database\\' . Configuration::dbNamespace() . '\\' . $this->objectName . ';' . PHP_EOL .
		       PHP_EOL . 'class ' . $this->extensionName . ' extends ' . $this->objectName . ' {' . PHP_EOL;
		file_put_contents($dir . $this->extensionName . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
	}

	private function closeExtension()
	{
		$str = '}' . PHP_EOL;
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
		$str = Configuration::TAB . 'function __constructor(' . implode(', ', $this->constructorArgs) . '){' . PHP_EOL .
		       Configuration::TAB . Configuration::TAB . 'parent::__constructor(' . implode(', ', array_keys($this->constructorArgs)) . ');' .
		       PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
		$this->editExtension($str);
	}

	private function tCount($joins, $c)
	{
		if (isset($joins[$c])) {
			return $this->tCount($joins, ($c + 1));
		}
		return $c;
	}

	private function createGet($reference, &$tableCount = 0, &$joins = array(), $prevAlias = FALSE)
	{
		$tableCount = $this->tCount($joins, $tableCount);
		$alias      = 'tbl' . $tableCount;
		$tblModel   = ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->table)));
		if (isset($this->functions[$tblModel])) return;
		$this->functions[$tblModel] = TRUE;
		if (empty($joins)) {
			$joins[$tableCount] =
				' JOIN \'.self::TABLE_NAME.\' ptbl ON (ptbl.' . $reference->referenced_column . ' = ' . $alias . '.' . $reference->column .
				' AND ptbl.' . $reference->referenced_column . ' = \'.(int)$' . $reference->referenced_column . '.\') ';
		} elseif ($prevAlias) {
			$joins[$tableCount] =
				' JOIN ' . $reference->referenced_table . ' ' . $prevAlias . ' ON (' . $prevAlias . '.' . $reference->referenced_column . ' = ' .
				$alias . '.' . $reference->column . ') ';
		}
		$str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
		       '@param $' . $reference->referenced_column . PHP_EOL . Configuration::TAB . ' * ' .
		       '@return ' . $tblModel . '[]' . PHP_EOL . Configuration::TAB . ' */' .
		       PHP_EOL . Configuration::TAB . 'function get' . $tblModel . '($' .
		       $reference->referenced_column . '){' . PHP_EOL . Configuration::TAB . Configuration::TAB .
		       '$query= \'SELECT ' . $alias . '.* FROM (' . $reference->table . ' ' . $alias . ')' . implode(' ', array_reverse($joins)) .
		       ';\';' . PHP_EOL . Configuration::TAB . Configuration::TAB .
		       '$qr=$this->DB->query($query);' . PHP_EOL . Configuration::TAB . Configuration::TAB .
		       'return $qr->custom_result_object(\'' . $tblModel . '\');' .
		       PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
		$this->editExtension($str);
		if (@$reference->children && is_array($reference->children)) {
			foreach ($reference->children as $childRef) {
				$this->createGet($childRef, $tableCount, $joins, $alias);
			}
		}
	}

	function generate(array $fields)
	{
		if (empty($fields)) return;
		$this->startExtension();
		$this->createConstructor();
		foreach ($fields as $field) {
			$this->createGet($field);
		}
		$this->closeExtension();
	}
}