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
    private $functions    = [];
    private $tableAliases = [];
    
    public function __construct(Table $table)
    {
        $this->table = $table;
    }
    
    function generate($references = [])
    {
        $this->startModel();
        $this->createProperties();
        $this->createConstructor();
        //$this->createSetters();
        //$this->createGetters();
        foreach ($references['bottom'] as $field) {
            if (!trim($field->table)) continue;
            $this->createBottomGet($field);
            $this->createCount($field);
        }
        foreach ($references['top'] as $field) {
            if (!trim($field->table)) continue;
            $this->createTopGet($field);
        }
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
            $str .= Configuration::TAB . 'public $' . $field->name . ';' . PHP_EOL;
            $this->editModel($str);
        }
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
    
    private function createCount($reference, $joins = [])
    {
        $tblModel = English::carmelCase($reference->table);// ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->table)));
        if (isset($this->functions['cnt' . $tblModel])) return;
        $this->functions['cnt' . $tblModel] = TRUE;
        if (empty($joins)) {
            $joins[] = '->where(\'' . $this->alias($reference->table) . '.' . $reference->column . '\', ' .
                '(int)$this->' . $reference->referenced_column . ')';
        } else {
            $joins[$reference->referenced_table] =
                '->joinInner(\'' . $reference->referenced_table . ' ' . $this->alias($reference->referenced_table) . '\', \'' .
                $this->alias($reference->referenced_table) . '.' . $reference->referenced_column . ' = ' . $this->alias($reference->table) .
                '.' . $reference->column . '\')';
        }
        $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
            '@return int' . PHP_EOL . Configuration::TAB . ' */' . PHP_EOL . Configuration::TAB .
            'function count' . English::pluralize($tblModel) . '(){' .
            PHP_EOL . Configuration::TAB(2) . 'if(!$this->' . $reference->referenced_column . ') return 0;' .
            PHP_EOL . Configuration::TAB(2) . '$this->PDOBuild' . implode(PHP_EOL . Configuration::TAB(3), array_reverse($joins)) . ';' . PHP_EOL .
            Configuration::TAB(2) . 'return $this->PDOBuild->table(\'' . $reference->table . '\',\'' . $this->alias($reference->table) . '\')->count();' .
            PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
        $str = str_ireplace($this->alias($reference->table), 't_tbl', $str);
        $this->editModel($str);
        if (@$reference->children && is_array($reference->children)) {
            foreach ($reference->children as $childRef) {
                $this->createCount($childRef, $joins);
            }
        }
    }
    
    private function createBottomGet($reference, $joins = [])
    {
        $tblModel = English::singularize(English::carmelCase($reference->table));// ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->table)));
        if (isset($this->functions[$tblModel])) return;
        $this->functions[$tblModel] = TRUE;
        if (empty($joins)) {
            $joins[] = '->where(\'' . $this->alias($reference->table) . '.' . $reference->column . '\', ' .
                '(int)$this->' . $reference->referenced_column . ')';
        } else {
            $joins[$reference->referenced_table] =
                '->joinInner(\'' . $reference->referenced_table . ' ' . $this->alias($reference->referenced_table) . '\', \'' .
                $this->alias($reference->referenced_table) . '.' . $reference->referenced_column . ' = ' . $this->alias($reference->table) .
                '.' . $reference->column . '\')';
        }
        $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
            '@param int $limit' . PHP_EOL . Configuration::TAB . ' * ' .
            '@param int $offset' . PHP_EOL . Configuration::TAB . ' * ' .
            '@return ' . $tblModel . '[]' . PHP_EOL . Configuration::TAB . ' */' . PHP_EOL . Configuration::TAB .
            'function get' . English::pluralize($tblModel) . '($limit = NULL, $offset = 0){' .
            PHP_EOL . Configuration::TAB(2) . 'if(!$this->' . $reference->referenced_column . ') return [];' .
            PHP_EOL . Configuration::TAB(2) . 'if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);' .
            PHP_EOL . Configuration::TAB(2) . '$this->PDOBuild' . implode(PHP_EOL . Configuration::TAB(3), array_reverse($joins)) . ';' . PHP_EOL .
            Configuration::TAB(2) . '$this->PDOBuild->select(\'' . $this->alias($reference->table) . '.*\');' .
            PHP_EOL . Configuration::TAB(2) . '/** @var ' . $tblModel . '[] $_e */' .
            PHP_EOL . Configuration::TAB(2) . '$_e = $this->PDOBuild->table(\'' . $reference->table . '\', \'' . $this->alias($reference->table) .
            '\')->getAll(\'\Database\\' . Configuration::dbNamespace() . '\\' . $tblModel . '\');' . PHP_EOL .
            Configuration::TAB(2) . 'return $_e;' . PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
        $str = str_ireplace($this->alias($reference->table), 't_tbl', $str);
        $this->editModel($str);
        if (@$reference->children && is_array($reference->children)) {
            foreach ($reference->children as $childRef) {
                $this->createBottomGet($childRef, $joins);
            }
        }
    }
    
    private function createTopGet($reference, $joins = [])
    {
        $tblModel = English::singularize(English::carmelCase($reference->referenced_table));//ucfirst(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $reference->referenced_table)));
        if (isset($this->functions['tg' . $tblModel])) return;
        $this->functions['tg' . $tblModel] = TRUE;
        if (empty($joins)) {
            $joins[] = '->where(\'' . $this->alias($reference->referenced_table) . '.' . $reference->referenced_column . '\', ' .
                '(int)$this->' . $reference->column . ')';
        } else {
            $joins[$reference->table] =
                '->joinInner(\'' . $reference->table . ' ' . $this->alias($reference->table) . '\', \'' .
                $this->alias($reference->table) . '.' . $reference->column . ' = ' . $this->alias($reference->referenced_table) .
                '.' . $reference->referenced_column . '\')';
        }
        $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ' .
            '@return ' . $tblModel . PHP_EOL . Configuration::TAB . ' */' . PHP_EOL . Configuration::TAB .
            'function get' . English::singularize($tblModel) . '(){' .
            PHP_EOL . Configuration::TAB(2) . 'if(!$this->' . $reference->column . ') return NULL;' .
            PHP_EOL . Configuration::TAB(2) . '$this->PDOBuild->limit(1)' . implode(PHP_EOL . Configuration::TAB(3), array_reverse($joins)) . ';' . PHP_EOL .
            PHP_EOL . Configuration::TAB(2) . '/** @var ' . $tblModel . ' $_e */' .
            PHP_EOL . Configuration::TAB(2) . '$_e = $this->PDOBuild->select(\'' . $this->alias($reference->referenced_table) . '.*\')' . '->table(\'' . $reference->referenced_table . '\', \'' . $this->alias($reference->referenced_table) .
            '\')->getOne(\'\Database\\' . Configuration::dbNamespace() . '\\' . $tblModel . '\');' . PHP_EOL .
            Configuration::TAB(2) . 'return $_e;' . PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
        $str = str_ireplace($this->alias($reference->referenced_table), 't_tbl', $str);
        $this->editModel($str);
        if (@$reference->children && is_array($reference->children)) {
            foreach ($reference->children as $childRef) {
                $this->createBottomGet($childRef, $joins);
            }
        }
    }
    
    private function createSetters()
    {
        /* @var $fields Tablefield[] */
        $fields = $this->table->getFields();
        $str    = [];
        foreach ($fields as $field) {
            $str [] = ' * @method $this set' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(' .
                $field->commentDataTypeName . ' $' . $field->name . ');';
        }
        return join(PHP_EOL, $str);
    }
    
    private function createGetters()
    {
        $str = [];
        /* @var $fields Tablefield[] */
        foreach ($this->table->getFields() as $field) {
            $str [] =
                ' * @method ' . $field->commentDataTypeName . ' get' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) .
                '();';
        }
        return join(PHP_EOL, $str);
    }
    
    private function createConstructor()
    {
        //We will inherit the parent's constructor
        $str = Configuration::TAB . ' /* function __construct($conditions=FALSE){' . PHP_EOL . Configuration::TAB(2) .
            'parent::__construct($conditions);' . PHP_EOL .
            Configuration::TAB . '} */' . PHP_EOL;
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
            PHP_EOL . 'use Database;' . PHP_EOL . PHP_EOL .
            '/**' . PHP_EOL . $this->createSetters() . PHP_EOL . $this->createGetters() . PHP_EOL . ' */' .
            PHP_EOL . 'class ' . $this->table->model . ' extends Database\DbActive{' . PHP_EOL . PHP_EOL;
        $str .= Configuration::TAB . 'CONST TABLE_NAME = \'' . $this->table->name . '\';' . PHP_EOL . PHP_EOL;
        $str .= Configuration::TAB . 'CONST DB_NAME = \'' . Configuration::$DB_NAME . '\';' . PHP_EOL . PHP_EOL;
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
