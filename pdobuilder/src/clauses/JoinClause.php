<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 16/12/2016
 * Time: 08:14 AM
 */

namespace pdobuilder\clause;


use pdobuilder\PdoBuilder;

class JoinClause extends QueryBuilder implements StatementClause
{
    private $JOIN  = [];
    private $TYPES = ['LEFT', 'RIGHT', 'CROSS', 'INNER', 'OUTER', 'FULL OUTER'];
    
    public function joinLeft($table, $condition = NULL) { $this->join($table, $condition, 'LEFT'); }
    
    public function joinRight($table, $condition = NULL) { $this->join($table, $condition, 'RIGHT'); }
    
    public function joinInner($table, $condition = NULL) { $this->join($table, $condition, 'INNER'); }
    
    public function joinOuter($table, $condition = NULL) { $this->join($table, $condition, 'OUTER'); }
    
    public function join($table, $condition = NULL, $type = 'LEFT')
    {
        if (is_callable($condition)) {
            $where = new WhereClause();
            $condition($where);
            $func = $where->getCompiled();
            if (is_string($func) && trim($func)) {
                $func = trim($func, '() ');
                try {
                    call_user_func_array([$this, 'join'], [$table, $func, $type]);
                } catch (\Exception $exception) {
                    throw new \Exception("Error in your select Sub-Query function: " . $exception->getMessage());
                }
            }
            return;
        }
        if (is_callable($table)) {
            $func = $table((new PdoBuilder()));
            if (is_string($func) && trim($func)) {
                $func = trim($func, '() ');
                try {
                    call_user_func_array([$this, 'join'], ["($func)", $condition, $type]);
                } catch (\Exception $exception) {
                    throw new \Exception("Error in your select Sub-Query function: " . $exception->getMessage());
                }
            }
            return;
        }
        if (!trim($table) || !is_string($table)) return;
        $this->joiner($table, $condition, $type);
    }
    
    private function joiner($table, $condition = NULL, $type)
    {
        $type         = in_array(strtoupper(trim($type)), $this->TYPES) ? trim($type) : 'LEFT';
        $this->JOIN[] = [$type, $this->esc($table), $condition ? $this->esc($condition) : NULL];
    }
    
    public function getClause()
    {
        return $this->JOIN;
    }
    
    public function getCompiled()
    {
        $join = [];
        foreach ($this->JOIN as $j) {
            $join[] = $j[0] . ' JOIN ' . $j[1] . ($j[2] ? ' ON (' . $j[2] . ')' : '');
        }
        return implode(' ', $join);
    }
}