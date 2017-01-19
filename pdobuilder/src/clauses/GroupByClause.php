<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:45 PM
 */

namespace pdobuilder\clause;

class GroupByClause extends QueryBuilder implements StatementClause
{
    private $GROUP_BY = [];
    
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
    
    private function addGrouping($column) { $this->GROUP_BY[] = $this->esc($column); }
    
    public function getClause()
    {
        return $this->GROUP_BY;
    }
    
    public function getCompiled()
    {
        return implode(',', $this->GROUP_BY);
    }
}