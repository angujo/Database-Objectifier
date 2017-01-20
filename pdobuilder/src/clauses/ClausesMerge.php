<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 03:34 PM
 */

namespace pdobuilder\clause;


use pdobuilder\QueryClause;

class ClausesMerge
{
    public $Between = 'pdobuilder\clause\BetweenClause';
    public $GroupBy = 'pdobuilder\clause\GroupByClause';
    public $Having  = 'pdobuilder\clause\HavingClause';
    public $Limit   = 'pdobuilder\clause\LimitClause';
    public $Order   = 'pdobuilder\clause\OrderClause';
    public $Select  = 'pdobuilder\clause\SelectClause';
    public $Where   = 'pdobuilder\clause\WhereClause';
    public $Join    = 'pdobuilder\clause\JoinClause';
    /** @var string|array */
    public $ColumnValue  = 'pdobuilder\clause\ColumnValueClause';
    public $PrimaryTable = '';
    
    public function __construct(QueryClause $clauses, $compileType = 0)
    {
        $this->compile($clauses, $compileType);
        return $this;
    }
    
    private function compile(QueryClause $clauses, $compileType)
    {
        $pri     = [];
        $clauses = $clauses->getClauses();
        $vars    = array_map(function ($value) use ($clauses) { return is_string($value) && isset($clauses[$value]) ? $clauses[$value] : ''; }, get_class_vars(get_class($this)));
        foreach ($vars as $var => $value) {
            if (is_string($value) && !trim($value)) {
                $this->{$var} = '';
                continue;
            }
            $this->{$var} = $value->getCompiled($compileType);
            if (!($tables = $value->getTables())) continue;
            $pri[] = implode(', ', $tables);
        }
        $this->PrimaryTable = implode(', ', $pri);
    }
}