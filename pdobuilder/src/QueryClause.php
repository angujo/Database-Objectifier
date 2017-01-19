<?php
namespace pdobuilder;
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 02:34 PM
 */
class QueryClause
{
    private $clauses = ['pdobuilder\clause\BetweenClause' => NULL, 'pdobuilder\clause\GroupByClause' => NULL, 'pdobuilder\clause\HavingClause' => NULL, 'pdobuilder\clause\LimitClause' => NULL,
                        'pdobuilder\clause\OrderClause'   => NULL, 'pdobuilder\clause\SelectClause' => NULL, 'pdobuilder\clause\WhereClause' => NULL, 'pdobuilder\clause\JoinClause' => NULL];
    
    function __call($name, $arguments)
    {
        foreach ($this->clauses as $clause => $instance) {
            if (NULL === $instance) $this->clauses[$clause] = new $clause();
            if (method_exists($this->clauses[$clause], $name)) {
                call_user_func_array([$this->clauses[$clause], $name], $arguments);
                return TRUE;
            }
        }
        return NULL;
    }
    
    public function getClauses() { return $this->clauses; }
}