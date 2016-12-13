<?php
namespace pdobuilder\clause;
use pdobuilder\QueryClauses;

/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 13/12/2016
 * Time: 04:06 PM
 */
class Select extends QueryClauses
{
    private $select = [];
    
    public function select()
    {
        $args = array_filter(func_get_args(), function ($s) { return (bool)trim($s); });
        if (!count($args)) return $this;
        if (1 == count($args)) {
            if (is_array($args[0])) {
                foreach ($args[0] as $col => $arg) {
                    $this->selectVerify($col, $arg);
                }
            } else {
                $this->_selector($args[0]);
            }
        } elseif (2 == count($args)) {
            if (is_array($args[0]) && FALSE === $args[1]) {
                foreach ($args[0] as $arg) {
                    $this->select($arg, NULL, FALSE);
                }
            } else {
                $this->_selector($args[0], $args[1]);
            }
        } else {
            if (is_array($args[0]) && NULL === $args[1] && FALSE === $args[2]) {
                foreach ($args[0] as $arg) {
                    $this->_selector($arg, NULL, FALSE);
                }
            } else {
                $this->_selector($args[0], $args[1], $args[2]);
            }
        }
        return $this;
    }
    
    private function selectVerify($col, $arg, $esc = TRUE)
    {
        if (is_int($col) && is_string($arg)) {
            $this->_selector($col, $arg, $esc);
        } elseif (is_int($arg) && is_int($col)) {
            $this->_selector($arg, NULL, FALSE);
        } elseif (is_array($arg) && 1 < count($arg)) {
            $this->select($col, $arg[0], $arg[1]);
        }
    }
    
    private function _selector($column, $alias = NULL, $escape = TRUE)
    {
        $alias = !$alias || !is_string($alias) ? NULL : $alias;
        if (!is_string($column) && !is_int($column)) return;
        if (NULL === $alias && FALSE === $escape) {
            //TODO Escape the column entry
            $this->select[] = $column;
        } elseif (FALSE === $escape && $alias) {
            //TODO Escape the column entry
            $this->select[] = $column . ' ' . $alias;
        } else {
            $this->select[] = $column . ($alias ? ' ' . $alias : '');
        }
    }
}