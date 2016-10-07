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
class Model {

    private $table;

    public function __construct(Table $table) {
        $this->table = $table;
    }

    function generate() {
        $this->startModel();
        $this->createProperties();
        $this->createConstructor();
        $this->createSetters();
        $this->createGetters();
        $this->closeModel();
    }

    private function createProperties() {
        foreach ($this->table->getFields() as $field) {
            /* @var $field Tablefield */
            $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
            if ($field->comment) {
                $str.= $field->comment . PHP_EOL . Configuration::TAB . ' * ';
            }
            $str.= $field->dataType . PHP_EOL . Configuration::TAB . ' * ';
            $str.= '@var ' . $field->commentDataTypeName;
            $str.= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
            $str .= Configuration::TAB . 'public $' . $field->name . ' = ' . $field->varDefaultValue . ';' . PHP_EOL;
            $this->editModel($str);
        }
    }

    private function createSetters() {
        $fields = $this->table->getFields();
        foreach ($fields as $field) {
            /* @var $field Tablefield */
            $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
            $str.= '@param ' . $field->commentDataTypeName . ' $' . $field->name;
            $str.= PHP_EOL . Configuration::TAB . ' * ';
            $str.= '@return Database\\'.Configuration::dbNamespace().'\Table\\'  . $this->table->model;
            $str.= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
            $str .= Configuration::TAB . 'public function set' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(' . $field->argDataTypeName . '$' . $field->name . '){' . PHP_EOL;
            $str.= Configuration::TAB . Configuration::TAB . '$this->' . $field->name . ' = ' . $field->constDefaultValue . ';' . PHP_EOL;
            $str.= Configuration::TAB . Configuration::TAB . 'return $this;' . PHP_EOL;
            $str .= Configuration::TAB . '}' . PHP_EOL;
            $this->editModel($str);
        }
    }

    private function createGetters() {
        foreach ($this->table->getFields() as $field) {
            /* @var $field Tablefield */
            $str = Configuration::TAB . '/**' . PHP_EOL . Configuration::TAB . ' * ';
            $str.= '@return '. $field->commentDataTypeName;
            $str.= PHP_EOL . Configuration::TAB . ' */' . PHP_EOL;
            $str .= Configuration::TAB . 'public function get' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(){' . PHP_EOL;
            $str.= Configuration::TAB . Configuration::TAB . 'return $this->' . $field->name . ';' . PHP_EOL;
            $str .= Configuration::TAB . '}' . PHP_EOL;
            $this->editModel($str);
        }
    }

    private function createConstructor() {
        $args = array();
        $instances = array();
        $fields = $this->table->getFields();
        foreach ($fields as $field) {
            /* @var $field Tablefield */
            if ($field->required) {
                $args[] = $field->argDataTypeName . '$' . $field->name . " = " . $field->varDefaultValue;
                $instances[] = Configuration::TAB . Configuration::TAB . '$this->' . $field->name . ' = ' . $field->constDefaultValue . ';';
            }
        }
        $str = Configuration::TAB . 'function __constructor(' . implode(', ', $args) . '){' . PHP_EOL . implode(PHP_EOL, $instances) . PHP_EOL . Configuration::TAB . '}' . PHP_EOL;
        $this->editModel($str);
    }

    private function startModel() {
        $dir = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName();
        if (!file_exists($dir) || !is_dir($dir)) {
            if (!mkdir($dir, 0755, TRUE)) {
                $this->startModel();
            }
        }
        $dir.=DIRECTORY_SEPARATOR;
        if (file_exists($dir . $this->table->model . '.php')) {
            unlink($dir . $this->table->model . '.php');
        }
        $str = '<?php ' . PHP_EOL . PHP_EOL . 'namespace Database\\' . Configuration::dbNamespace() .'\Table;'. PHP_EOL . PHP_EOL . 'class ' . $this->table->model . '{' . PHP_EOL . PHP_EOL;
        $str.=Configuration::TAB . 'CONST TABLE_NAME = \'' . $this->table->name . '\';' . PHP_EOL;
        file_put_contents($dir . $this->table->model . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function closeModel() {
        $str = '}' . PHP_EOL;
        $this->editModel($str);
    }

    private function editModel($string) {
        $dir = Configuration::$MODELS_DIRECTORY . Configuration::dbDirectoryName() . DIRECTORY_SEPARATOR;
        if (!file_exists($dir . $this->table->model . '.php')) {
            $this->startModel();
        }
        file_put_contents($dir . $this->table->model . '.php', $string . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

}
