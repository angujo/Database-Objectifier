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
class Tablefield
{

	public  $name                = '';
	public  $dataType            = '';
	public  $required            = FALSE;
	public  $table               = '';
	public  $comment             = '';
	public  $defaultValue        = '';
	public  $varDefaultValue     = '';
	public  $constDefaultValue   = '';
	public  $commentDataTypeName = '';
	public  $argDataTypeName     = '';
	public  $label               = '';
	public  $unique              = FALSE;
	private $enumOptions         = array();

	function __construct(array $details)
	{
		$this->load($details);
	}

	private function load(array $details)
	{
		$this->name     = preg_replace("/[^a-zA-Z0-9]/", "_", $details['Field']);
		$this->dataType = $details['Type'];
		if ('id' != strtolower($this->name) && 'no' == trim(strtolower($details['Null'])) &&
		    (0 >= strlen($details['Default']) || 'auto_increment' != $details['Extra'])
		) {
			$this->required = TRUE;
		}
		$this->comment      = $details['Comment'];
		$this->label        = addslashes(trim($this->comment) ?: ucwords(trim(preg_replace('/[^a-zA-Z0-9]/', ' ', $this->name))));
		$this->defaultValue = $details['Default'];
		$this->unique       = 'uni' == trim(strtolower($details['Key']));
		$this->setDefaultValue();
	}

	private function setDefaultValue()
	{
		$this->constDefaultValue   = '$' . $this->name;
		$this->varDefaultValue     = "''";
		$this->argDataTypeName     = '';
		$this->commentDataTypeName = 'string ';
		if ('current_timestamp' == trim(strtolower($this->defaultValue)) || 'datetime' == trim(strtolower($this->dataType)) ||
		    'timestamp' == trim(strtolower($this->dataType))
		) {
			$this->constDefaultValue = '$' . $this->name . '? : ' . "date('Y-m-d H:i:s')";
			//$this->varDefaultValue   = "date('Y-m-d H:i:s')";
		} elseif ('year' == trim(strtolower($this->dataType))) {
			$this->constDefaultValue = '$' . $this->name . '? : ' . "date('Y')";
			//$this->varDefaultValue   = "date('Y')";
		} elseif ('time' == trim(strtolower($this->dataType))) {
			$this->constDefaultValue = '$' . $this->name . '? : ' . "date('H:i:s')";
			//$this->varDefaultValue   = "date('H:i:s')";
		} elseif ('date' == trim(strtolower($this->dataType))) {
			$this->constDefaultValue = '$' . $this->name . '? : ' . "date('Y-m-d')";
			//$this->varDefaultValue   = "date('Y-m-d')";
		} elseif ($this->ofBool($this->dataType)) {
			$this->commentDataTypeName = 'bool ';
			$this->constDefaultValue   = '(bool) $' . $this->name;
			$this->varDefaultValue     = 'FALSE';
		} elseif ($this->ofNumeric($this->dataType)) {
			$this->commentDataTypeName = 'float ';
			$this->constDefaultValue   = 'is_numeric($' . $this->name . ') ? $' . $this->name . ' : 0';
			$this->varDefaultValue     = 0;
		} elseif ($this->ofEnum($this->dataType)) {
			$f                       = @$this->enumOptions[0];
			$this->constDefaultValue =
				'in_array( $' . $this->name . ', array(\'' . implode('\', \'', $this->enumOptions) . '\')) ? $' . $this->name . ' : ' . "'" .
				$f . "'";
			$this->varDefaultValue   = "'" . $f . "'";
		} elseif (0 === strpos($this->dataType, 'decimal')) {
			$this->constDefaultValue   = 'is_numeric($' . $this->name . ') ? $' . $this->name . ' : 0.0';
			$this->varDefaultValue     = '0.0';
			$this->commentDataTypeName = 'float ';
		}

		if ($this->ofInt($this->dataType)) {
			$this->commentDataTypeName = 'int ';
		}
		if ($this->ofFloat($this->dataType)) {
			$this->commentDataTypeName = 'float ';
		}
	}

	private function ofNumeric($dType)
	{
		$check = array('int', 'float', 'double', 'bigint', 'mediumint', 'numeric', 'real', 'smallint', 'bigint', 'tinyint');
		foreach ($check as $value) {
			if (0 === strpos($dType, $value)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function ofFloat($dType)
	{
		$check = array('float', 'double', 'numeric', 'real');
		foreach ($check as $value) {
			if (0 === strpos($dType, $value)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function ofInt($dType)
	{
		$check = array('int', 'bigint', 'mediumint', 'smallint', 'bigint', 'tinyint');
		foreach ($check as $value) {
			if (0 === strpos($dType, $value)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function ofBool($dType)
	{
		$check = array('bool', 'boolean', 'bit');
		foreach ($check as $value) {
			if (0 === strpos($dType, $value)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	private function ofEnum($dType)
	{
		if (0 === strpos($dType, 'enum')) {
			$this->enumOptions = array_map(function ($v) {
				return trim($v, "'");
			}, explode(',', trim(str_ireplace('enum', '', $dType), '()')));
			return TRUE;
		}
		return FALSE;
	}

}
