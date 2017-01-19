<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 22/12/2016
 * Time: 12:18 PM
 */

namespace pdobuilder\clause;


class ColumnValueClause extends QueryBuilder implements StatementClause
{
    private $COLVAL = [];
    
    public function columnValue($column, $value = NULL, $escape = FALSE)
    {
        if (is_array($column)) {
            foreach ($column as $col => $val) {
                if (!is_string($col) || (is_array($val) && 1 >= count($val))) continue;
                if (is_array($val)) {
                    $this->columnValue($val[0], $val[1], (isset($val[2]) && is_bool($val) ? $val[2] : FALSE));
                } else {
                    $this->columnValue($col, $val, $escape);
                }
            }
            return $this;
        }
        if (!trim($column)) return $this;
        $this->addColVal($column, $value, $escape);
        return $this;
    }
    
    private function addColVal($column, $value, $escape)
    {
        $this->COLVAL[$this->esc($column)] = FALSE === $escape ? $this->valueBind($value) : $this->esc($value);
    }
    
    public function getClause()
    {
        // TODO: Implement getClause() method.
    }
    
    public function getCompiled()
    {
        $colval = '';
    }
}