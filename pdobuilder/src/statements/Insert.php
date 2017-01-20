<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 8:25 PM
 */

namespace pdobuilder\statement;

use pdobuilder\clause\ClausesMerge;

class Insert extends Query
{
    private $statement = [];
    private $clauses;
    
    function __construct(ClausesMerge $clausesMerge)
    {
        $this->clauses = $clausesMerge;
        $this->organizeStatement();
    }
    
    private function organizeStatement()
    {
        $this->statement[] = 'INSERT';
        $this->statement[] = 'INTO';
        if (!$this->clauses->PrimaryTable) throw new \Exception('Table must be defined!');
        $this->statement[] = $this->clauses->PrimaryTable;
        if (!$this->clauses->ColumnValue || !is_array($this->clauses->ColumnValue) || 2 != count($this->clauses->ColumnValue)) throw new \Exception('Insert parameters must be set!');
        $this->statement[] = '(' . $this->clauses->ColumnValue[0] . ')';
        $this->statement[] = 'VALUES';
        $this->statement[] = '(' . $this->clauses->ColumnValue[1] . ')';
    }
    
    public function getQuery()
    {
        return parent::compiledQuery($this->statement);
    }
    
    public function getRaw() { return parent::rawQuery($this->statement); }
}