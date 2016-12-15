<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:56 PM
 */

namespace pdobuilder\clause;

class BetweenClause extends QueryBuilder
{
    function betweenDates($column, $min, $max)
    {
        $this->between($column, "CONVERT(" . $this->valueBind($min) . ", DATE)", "CONVERT(" . $this->valueBind($max) . ", DATE)", TRUE);
    }
    
    function orBetweenDates($column, $min, $max)
    {
        $this->orBetween($column, "CONVERT(" . $this->valueBind($min) . ", DATE)", "CONVERT(" . $this->valueBind($max) . ", DATE)", TRUE);
    }
    
    function between($column, $min, $max, $esc = NULL)
    {
        if (is_array($column)) {
            foreach ($column as $item) {
                if (is_array($item)) continue;
                $this->addBetween($item, $min, $max, FALSE, $esc);
            }
            return;
        }
        $this->addBetween($column, $min, $max, FALSE, $esc);
    }
    
    function orBetween($column, $min, $max, $esc = NULL)
    {
        if (is_array($column)) {
            foreach ($column as $item) {
                if (is_array($item)) continue;
                $this->addBetween($item, $min, $max, TRUE, $esc);
            }
            return;
        }
        $this->addBetween($column, $min, $max, TRUE, $esc);
    }
    
    private function addBetween($column, $min, $max, $isOR = FALSE, $escaped = FALSE)
    {
        if (is_array($min) || is_array($max)) return;
        self::$BETWEEN[] = [$isOR ? 'OR' : 'AND', $this->esc($column), (!$escaped ? $this->valueBind($min) : $min), (!$escaped ? $this->valueBind($max) : $max)];
    }
}