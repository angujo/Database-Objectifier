<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:45 PM
 */

namespace pdobuilder\clause;

use pdobuilder\QueryBuilder;

class GroupByClause extends QueryBuilder
{
    function groupBy($column)
    {
        if (is_array($column)) {
            foreach ($column as $item) {
                if (!is_string($column)) continue;
                $this->groupBy($item);
            }
        }
        if (!is_string($column)) return;
        $this->addGrouping($column);
    }
    
    private function addGrouping($column) { self::$GROUP_BY[] = $this->esc($column); }
}