<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tablefield
 *
 * @author bangujo
 */
class Tablefield {

    public $name = '';
    public $dataType = '';
    public $required = false;
    public $table = '';
    public $comment = '';
    public $defaultValue = '';
    public $varDefaultValue = '';
    public $constDefaultValue = '';
    public $commentDataTypeName = '';
    public $argDataTypeName = '';
    private $enumOptions = array();

    function __construct($name = '', $dType = '', $required = false, $comment = '', $default = '') {
        //$this->table = $table;
        $this->name = preg_replace("/[^a-zA-Z0-9]/", "_", $name);
        $this->dataType = $dType;
        $this->required = (!$default && $required);
        $this->comment = $comment;
        $this->defaultValue = $default;
        $this->commentDataTypeName = $this->setDataName('comment');
        $this->argDataTypeName = $this->setDataName('arg');
        $this->varDefaultValue = $this->varDefaultValue();
        $this->constDefaultValue = $this->constInstantiateValue();
    }

    private function setDefaultValue($type) {
        if ('var' != $type) {
            if ('current_timestamp' == trim(strtolower($this->defaultValue)) || 'datetime' == trim(strtolower($this->dataType)) || 'timestamp' == trim(strtolower($this->dataType))) {
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y-m-d H:i:s')" : "date('Y-m-d H:i:s')";
            }
            if ('year' == trim(strtolower($this->dataType))) {
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y')" : "date('Y')";
            }
            if ('time' == trim(strtolower($this->dataType))) {
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('H:i:s')" : "date('H:i:s')";
            }
            if ('date' == trim(strtolower($this->dataType))) {
                return 'const' == $type ? '$' . $this->name . '? : ' . "date('Y-m-d')" : "date('Y-m-d')";
            }
        }

        if ($this->ofBool($this->dataType)) {
            return 'const' == $type ? '(bool) $' . $this->name : 'FALSE';
        }

        if ($this->ofNumeric($this->dataType)) {
            return 'const' == $type ? 'is_numeric($' . $this->name . ') ? $' . $this->name . ' : 0' : 0;
        }
        if ($this->ofEnum($this->dataType)) {
            $f = @$this->enumOptions[0];
            return 'const' == $type ? 'in_array( $' . $this->name . ', array(\'' . implode('\', \'', $this->enumOptions) . '\')) ? $' . $this->name . ' : ' . "'" . $f . "'" : "'" . $f . "'";
        }
        return 'const' == $type ? '$' . $this->name : "''";
    }

    private function varDefaultValue() {
        return $this->setDefaultValue('var');
    }

    private function constInstantiateValue() {
        return $this->setDefaultValue('const');
    }

    private function ofNumeric($dType) {
        $check = array('int', 'float', 'double', 'bigint', 'mediumint', 'numeric', 'real', 'smallint', 'bigint', 'tinyint');
        foreach ($check as $value) {
            if (0 === strpos($dType, $value)) {
                return true;
            }
        }
        return FALSE;
    }

    private function ofFloat($dType) {
        $check = array('float', 'double', 'numeric', 'real');
        foreach ($check as $value) {
            if (0 === strpos($dType, $value)) {
                return true;
            }
        }
        return FALSE;
    }

    private function ofInt($dType) {
        $check = array('int', 'bigint', 'mediumint', 'smallint', 'bigint', 'tinyint');
        foreach ($check as $value) {
            if (0 === strpos($dType, $value)) {
                return true;
            }
        }
        return FALSE;
    }

    private function ofBool($dType) {
        $check = array('bool', 'boolean', 'bit');
        foreach ($check as $value) {
            if (0 === strpos($dType, $value)) {
                return true;
            }
        }
        return FALSE;
    }

    private function ofEnum($dType) {
        if (0 === strpos($dType, 'enum')) {
            $this->enumOptions = array_map(function($v) {
                return trim($v, "'");
            }, explode(',', trim(str_ireplace('enum', '', $dType), '()')));
            return true;
        }
        return FALSE;
    }

    private function setDataName($type = 'comment') {
        $type = version_compare(PHP_VERSION, '5.6.0', '>') ? 'comment' : $type;
        if ($this->ofInt($this->dataType)) {
            return 'comment' != $type ? '' : 'int ';
        }
        if ($this->ofBool($this->dataType)) {
            return 'comment' != $type ? '' : 'bool ';
        }

        if ($this->ofFloat($this->dataType)) {
            return 'comment' != $type ? 'int ' : 'float ';
        }
        return 'comment' != $type ? '' : 'string ';
    }

}
