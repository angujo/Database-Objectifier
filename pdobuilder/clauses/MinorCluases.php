<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 13/12/2016
 * Time: 04:10 PM
 */

namespace pdobuilder\clause\minor {
    
    use pdobuilder\QueryClauses;
        
    class Between extends QueryClauses
    {
        private static $between = [];
    }
    
    class Limit extends QueryClauses
    {
        private static $limit = [2100, 0];
        
        public function __construct($length, $offset)
        {
            self::$limit = [(int)$length, (int)$offset];
        }
    }
    
    class OrderBy extends QueryClauses
    {
        private static $orderBy = [];
        
        function __construct($column, $order = NULL)
        {
            $this->doOrder($column, $order);
        }
        
        private function doOrder($column, $order = NULL)
        {
            if (is_array($column)) {
                foreach ($column as $col => $ord) {
                    if (is_string($col) && $this->validOrder($ord)) $this->doOrder($col, $ord);
                    elseif (is_string($col) && $this->validOrder($order)) $this->doOrder($col, $order);
                    elseif (is_string($ord) && $this->validOrder($order)) $this->doOrder($ord, $order);
                }
            } elseif (is_string($column)) {
                $order                  = $this->validOrder($order) ? strtoupper(trim($order)) : 'ASC';
                self::$orderBy[$column] = $order;
            }
        }
        
        private function validOrder($order)
        {
            return in_array(strtolower(trim($order)), ['asc', 'desc']);
        }
    }
    
    class GroupBy
    {
        private static $groupBy = [];
        
        function __construct($column)
        {
            if (is_array($column)) {
                foreach ($column as $item) {
                    if (!is_string($column)) continue;
                    $this->groupBy($item);
                }
            }
            if (!is_string($column)) return;
            //TODO Escape
            $this->groupBy[] = $column;
        }
    }
}