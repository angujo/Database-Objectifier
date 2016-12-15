<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 8:25 PM
 */

namespace pdobuilder\statement;

use pdobuilder\clause\QueryBuilder;

class Read
{
    private $statement = [];
    
    function __construct()
    {
    }
    
    private function organizeStatement()
    {
        if (empty(QueryBuilder::$PRIMARY_TABLES)) throw new \Exception("Tables not defined!");
        $this->statement[] = 'SELECT';
        if (empty(QueryBuilder::$SELECT)) {
            $this->statement[] = '*';
        } else {
            $this->statement[] = implode(', ', array_map(function ($s) { return trim($s); }, QueryBuilder::$SELECT));
        }
        $this->statement[] = 'FROM';
        $this->statement[] = implode(',', QueryBuilder::$PRIMARY_TABLES);
        if (!empty(QueryBuilder::$WHERE)) {
            $this->statement[] = 'WHERE';
            $where             = '';
            foreach (QueryBuilder::$WHERE as $whereC) {
                $where .= ($where ? $whereC[0] : '');
                $where .= $whereC[1];
            }
            $this->statement[] = $where;
        }
        if (!empty(QueryBuilder::$GROUP_BY)) {
            $this->statement[] = 'GROUP BY';
            $this->statement[] = implode(',', QueryBuilder::$GROUP_BY);
        }
        if (!empty(QueryBuilder::$HAVING)) {
            $this->statement[] = 'HAVING';
            $having             = '';
            foreach (QueryBuilder::$HAVING as $have) {
                $having .= ($having ? $have[0] : '');
                $having .= $have[1];
            }
            $this->statement[] = $having;
        }
        if(!empty(QueryBuilder::$ORDER_BY)){
            
        }
    }
}