<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 8:25 PM
 */

namespace pdobuilder\statement;

use pdobuilder\clause\ClausesMerge;
use pdobuilder\clause\QueryBuilder;

class Delete extends Query
{
    private $statement = [];
    private $clauses;
    private $alias     = NULL;
    
    function __construct(ClausesMerge $clausesMerge, $alias = NULL)
    {
        $this->alias = (is_array($alias) ? implode(', ', array_filter($alias)) : (($alias && (is_string($alias) || is_numeric($alias))) ? $alias : NULL));
        if ($this->alias) {
            $this->alias = QueryBuilder::escape($this->alias);
        }
        $this->clauses = $clausesMerge;
        $this->organizeStatement();
    }
    
    private function organizeStatement()
    {
        if (!$this->clauses->PrimaryTable) throw new \Exception('Table must be defined!');
        $this->statement[] = 'DELETE';
        if ($this->alias) $this->statement[] = $this->alias;
        $this->statement[] = 'FROM';
        $this->statement[] = $this->clauses->Join ? '(' . $this->clauses->PrimaryTable . ')' : $this->clauses->PrimaryTable;
        if ($this->clauses->Join) {
            $this->statement[] = $this->clauses->Join;
        }
        if ($this->clauses->Where) {
            $this->statement[] = 'WHERE';
            $this->statement[] = $this->clauses->Where;
        }
        if ($this->clauses->Between) {
            if (!$this->clauses->Where)
                $this->statement[] = 'WHERE';
            $this->statement[] = $this->btwnAppend($this->clauses->Between, $this->clauses->Where);
        }
        if ($this->clauses->GroupBy) {
            $this->statement[] = 'GROUP BY';
            $this->statement[] = $this->clauses->GroupBy;
        }
        if ($this->clauses->Having) {
            $this->statement[] = 'HAVING';
            $this->statement[] = $this->clauses->Having;
        }
        if ($this->clauses->Order) {
            $this->statement[] = 'ORDER BY';
            $this->statement[] = $this->clauses->Order;
        }
        if ($this->clauses->Limit) {
            $this->statement[] = 'LIMIT';
            $this->statement[] = $this->clauses->Limit;
        }
    }
    
    public function getQuery()
    {
        return parent::compiledQuery($this->statement);
    }
    
    public function getRaw() { return parent::rawQuery($this->statement); }
}