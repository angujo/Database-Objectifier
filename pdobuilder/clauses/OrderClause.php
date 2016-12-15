<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:37 PM
 */

namespace pdobuilder\clause;

class OrderClause extends QueryBuilder
{
    function orderBy($column, $order) { $this->doOrder($column, $order); }
    
    private function doOrder($column, $order = NULL)
    {
        if (is_array($column)) {
            foreach ($column as $col => $ord) {
                if (is_string($col) && $this->validOrder($ord)) $this->doOrder($col, $ord);
                elseif (is_string($col) && $this->validOrder($order)) $this->doOrder($col, $order);
                elseif (is_string($ord) && $this->validOrder($order)) $this->doOrder($ord, $order);
            }
        } elseif (is_string($column)) {
            $order = $this->validOrder($order) ? strtoupper(trim($order)) : 'ASC';
            $this->addOrder($column, $order);
        }
    }
    
    private function addOrder($column, $order) { self::$ORDER_BY[] = [$this->esc($column) => $order]; }
    
    private function validOrder($order)
    {
        return in_array(strtolower(trim($order)), ['asc', 'desc']);
    }
}