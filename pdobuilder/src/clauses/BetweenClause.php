<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:56 PM
 */

namespace pdobuilder\clause;

class BetweenClause extends QueryBuilder implements StatementClause
{
    private $BETWEEN = [];
    
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
        $this->BETWEEN[] = [$isOR ? 'OR' : 'AND', $this->esc($column), (!$escaped ? $this->valueBind($min) : $min), (!$escaped ? $this->valueBind($max) : $max)];
    }
    
    public function getClause()
    {
        return $this->BETWEEN;
    }
    
    public function getCompiled()
    {
        $btn = '';
        foreach ($this->BETWEEN as $btwn) {
            //$btn .= ($btn ?' '.  : '');
            $btn .= ' '.$btwn[0].' (' . $btwn[1] . ' BETWEEN ' . $btwn[2] . ' AND ' . $btwn[3] . ')';
        }
        return $btn;
    }
}