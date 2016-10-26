<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 26-Oct-16
 * Time: 6:07 AM
 */

namespace Database;


class DbExtend
{
	private $DB;

	public function __construct(&$DB)
	{
		$this->DB = &$DB;
	}

	function whereTarget($column, $value = NULL)
	{
		$this->DB->where('t_tbl.' . $column, $value);
	}

	function wherePrimary($column, $value = NULL)
	{
		$this->DB->where('ptbl.' . $column, $value);
	}

	function orderBy($column, $mode = 'DESC')
	{
		$this->DB->order_by('t_tbl.' . $column, $mode);
	}
}