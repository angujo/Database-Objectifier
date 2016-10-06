<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dbobjectifier
 *
 * @author bangujo
 */
class Dbobjectifier {

    private static $MODELS_DIRECTORY = '';
    private static $DB_USERNAME = 'root';
    private static $DB_NAME = 'sakila';
    private static $DB_PASS = 'root';
    private static $DB_HOST = 'localhost';

    const TAB = '    ';

    private $PDO = null;

    function __construct($directory) {
        self::$MODELS_DIRECTORY = $directory;
        try {
            $this->PDO = new PDO('mysql:host=' . self::$DB_HOST . ';dbname=' . self::$DB_NAME . ';charset=utf8', self::$DB_USERNAME, self::$DB_PASS);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            die();
        }
    }

    private function databaseExist() {
        $stmt = $this->PDO->query('SHOW DATABASES WHERE `Database` LIKE \'' . self::$DB_NAME . '\'');
        if (!$stmt) {
            throw new Exception($this->PDO->errorInfo());
        }
        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('Missing Database! Ensure DB Exists!');
        }
        return TRUE;
    }

    private function getTables() {
        $stmt = $this->PDO->query('SHOW TABLES FROM `' . self::$DB_NAME . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $tables = array();
        $tbs = $stmt->fetchAll(PDO::FETCH_NUM);
        foreach ($tbs as $row) {
            $tables[] = $row[0];
        }
        return $tables;
    }

    /**
     * 
     * @param type $tableName
     * @return \Tablefield
     */
    private function getTableFields($tableName) {
        $stmt = $this->PDO->query('SHOW FULL COLUMNS FROM `' . $tableName . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $columns = array();
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $row) {
            $columns[] = new Tablefield($tableName, $row['Field'], $row['Type'], 'no' == trim(strtolower($row['Null'])), $row['Comment']);
        }
        return $columns;
    }

    /**
     * 
     * @param Tablefield $field
     */
    private function createProperty(Tablefield $field) {
        $str = self::TAB . '/**' . PHP_EOL . self::TAB . '* ';
        if ($field->comment) {
            $str.= $field->comment . PHP_EOL . self::TAB . '* ';
        }
        $str.= '@var $' . $field->name;
        $str.= PHP_EOL . self::TAB . '*/' . PHP_EOL;
        $str .= self::TAB . 'public $' . $field->name . ' = ' . $field->varDefaultValue() . ';' . PHP_EOL;
        $this->editModel($field->table, $str);
    }

    private function createSetter(Tablefield $field) {
        $str = self::TAB . '/**' . PHP_EOL . self::TAB . '* ';
        $str.= '@param $' . $field->name;
        $str.= PHP_EOL . self::TAB . '* ';
        $str.= '@return ' . $field->className;
        $str.= PHP_EOL . self::TAB . '*/' . PHP_EOL;
        $str .= self::TAB . 'public function set' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '($' . $field->name . '){' . PHP_EOL;
        $str.= self::TAB . self::TAB . '$this->' . $field->name . ' = ' . $field->constInstantiateValue() . ';' . PHP_EOL;
        $str.= self::TAB . self::TAB . 'return $this;' . PHP_EOL;
        $str .= self::TAB . '}' . PHP_EOL;
        $this->editModel($field->table, $str);
    }

    private function createGetter(Tablefield $field) {
        $str = self::TAB . '/**' . PHP_EOL . self::TAB . '* ';
        $str.= '@return $' . $field->name;
        $str.= PHP_EOL . self::TAB . '*/' . PHP_EOL;
        $str .= self::TAB . 'public function get' . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $field->name))) . '(){' . PHP_EOL;
        $str.= self::TAB . self::TAB . 'return $this->' . $field->name . ';' . PHP_EOL;
        $str .= self::TAB . '}' . PHP_EOL;
        $this->editModel($field->table, $str);
    }

    private function createConstructor($tableName, array $fields) {
        $args = array();
        $instances = array();
        foreach ($fields as $field) {
            if ($field->required) {
                $args[] = '$' . $field->name . " = " . $field->varDefaultValue();
                $instances[] = self::TAB . self::TAB . '$this->' . $field->name . ' = ' . $field->constInstantiateValue() . ';';
            }
        }
        $str = self::TAB . 'function __constructor(' . implode(', ', $args) . '){' . PHP_EOL . implode(PHP_EOL, $instances) . PHP_EOL . self::TAB . '}' . PHP_EOL;
        $this->editModel($tableName, $str);
    }

    private function startModel($tableName) {
        $tableName = ucfirst(strtolower(trim(preg_replace("/[^a-zA-Z0-9]/", "", $tableName))));
        if (file_exists(self::$MODELS_DIRECTORY . $tableName . '.php'))
            unlink(self::$MODELS_DIRECTORY . $tableName . '.php');
        $str = '<?php ' . PHP_EOL . PHP_EOL . 'class ' . $tableName . '{' . PHP_EOL . PHP_EOL;
        file_put_contents(self::$MODELS_DIRECTORY . $tableName . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function closeModel($tableName) {
        $str = '}' . PHP_EOL;
        $this->editModel($tableName, $str);
    }

    private function editModel($tableName, $string) {
        $tableName = ucfirst(strtolower(trim(preg_replace("/[^a-zA-Z0-9]/", "", $tableName))));
        if (!file_exists(self::$MODELS_DIRECTORY . $tableName . '.php')) {
            $str = '<?php ' . PHP_EOL . PHP_EOL . 'class ' . $tableName . '{' . PHP_EOL . PHP_EOL;
            file_put_contents(self::$MODELS_DIRECTORY . $tableName . '.php', $str . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
        file_put_contents(self::$MODELS_DIRECTORY . $tableName . '.php', $string . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function standingModel($table) {
        $this->startModel($table);
        $fields = $this->getTableFields($table);
        foreach ($fields as $field) {
            $this->createProperty($field);
        }
        $this->createConstructor($table, $fields);
        foreach ($fields as $field) {
            $this->createSetter($field);
        }
        foreach ($fields as $field) {
            $this->createGetter($field);
        }
        $this->closeModel($table);
    }

    function generate() {
        $this->databaseExist();
        $tables = $this->getTables();
        foreach ($tables as $table) {
            $this->standingModel($table);
        }
    }

}

class Tablefield {

    public $name = '';
    public $dataType = '';
    public $required = false;
    public $table = '';
    public $comment = '';
    public $className = '';
    public $defaultValue = '';

    function __construct($table, $name = '', $dType = '', $required = false, $comment = '', $default = '') {
        $this->table = $table;
        $this->name = preg_replace("/[^a-zA-Z0-9]/", "_", $name);
        $this->dataType = $dType;
        $this->required = (!$default && $required);
        $this->comment = $comment;
        $this->defaultValue = $default;
        $this->className = ucfirst(strtolower(trim(preg_replace("/[^a-zA-Z0-9]/", "", $table))));
    }

    private function setDefaultValue($type) {
        if ('var' != $type) {
            if ('current_timestamp' == trim(strtolower($this->defaultValue)) || 'datetime' == trim(strtolower($this->dataType)) || 'timestamp' == trim(strtolower($this->dataType))) {
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y-m-d H:i:s')" : "date('Y-m-d H:i:s')";
            }
            if ('year' == trim(strtolower($this->dataType)))
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y')" : "date('Y')";
            if ('time' == trim(strtolower($this->dataType)))
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('H:i:s')" : "date('H:i:s')";
            if ('date' == trim(strtolower($this->dataType)))
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y-m-d')" : "date('Y-m-d')";
        }

        if ($this->ofNumeric($this->dataType))
            return 'const' == $type ? 'is_numeric($' . $this->name . ') ? $' . $this->name . ' : 0' : 0;
        return 'const' == $type ? '$' . $this->name : "''";
    }

    function varDefaultValue() {
        return $this->setDefaultValue('var');
    }

    function constInstantiateValue() {
        return $this->setDefaultValue('const');
    }

    private function ofNumeric($dType) {
        $check = array('int', 'float', 'double', 'bigint', 'bit', 'mediumint', 'numeric', 'real', 'smallint', 'bigint');
        foreach ($check as $value) {
            if (0 === strpos($dType, $value))
                return true;
        }
        return FALSE;
    }

}
