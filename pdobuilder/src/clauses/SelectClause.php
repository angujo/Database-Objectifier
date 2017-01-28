<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:04 PM
 */

namespace pdobuilder\clause;

use pdobuilder\PdoBuilder;

class SelectClause extends QueryBuilder implements StatementClause
{
    private $SELECT = [];
    
    public function distinct()
    {
        if ($this->SELECT && 0 == strcasecmp('distinct', $this->SELECT[0])) return;
        array_unshift($this->SELECT, 'DISTINCT');
    }
    
    public function tableSelect($tableName, array $columns)
    {
        foreach ($columns as $column => $alias) {
            if (is_numeric($column)) {
                $column = $alias;
                $alias  = NULL;
            }
            $this->select($tableName . '.' . $column, $alias);
        }
    }
    
    public function select()
    {
        $args = func_get_args();
        if (!count($args)) return $this;
        if (is_callable($args[0])) {
            $func = $args[0]((new PdoBuilder()));
            if (is_string($func) && trim($func)) {
                $args[0] = '(' . trim($func, '( ') . ')';
                try {
                    return call_user_func_array([$this, 'select'], $args);
                } catch (\Exception $exception) {
                    throw new \Exception("Error in your select Sub-Query function: " . $exception->getMessage());
                }
            } else {
                throw new \Exception("Select Function should return a string query. Always return getQuery() at the end!");
            }
        }
        if (is_array($args[0])) {
            $this->arrayed($args[0], (isset($args[1]) && TRUE === $args[1]));
            return $this;
        }
        if (1 == count($args)) {
            if (NULL === $args[0]) {
                $this->SELECT = [];
                return $this;
            }
            $this->_selector($args[0]);
        } elseif (2 == count($args)) {
            $this->_selector($args[0], $args[1]);
        } else {
            $this->_selector($args[0], $args[1], $args[2]);
        }
        return $this;
    }
    
    private function arrayed(array $columns, $asIs = FALSE)
    {
        $expect = -1;
        ksort($columns);
        foreach ($columns as $column => $alias) {
            if ($asIs === TRUE) {
                $this->_selector($column, $alias);
                continue;
            }
            $col = (int)$column;
            if (is_int($column) && $col == ($expect + 1)) $this->_selector($alias);
            else $this->_selector($column, $alias);
            if (is_int($col))
                $expect = $column;
        }
    }
    
    private function selectVerify($col, $arg, $esc = TRUE)
    {
        if (is_int($col) && is_string($arg)) {
            $this->_selector($col, $arg, $esc);
        } elseif (is_int($arg) && is_int($col)) {
            $this->_selector($arg, NULL, FALSE);
        } elseif (is_array($arg) && 1 < count($arg)) {
            $this->select($col, $arg[0], $arg[1]);
        }
    }
    
    private function _selector($column, $alias = NULL, $escape = TRUE)
    {
        $alias = !$alias || !is_string($alias) ? NULL : $alias;
        if (!is_string($column) && !is_int($column)) return;
        if (NULL === $alias && FALSE === $escape) {
            $this->SELECT[] = ($column);
        } elseif (FALSE === $escape && $alias) {
            $this->SELECT[] = ($column . ' ' . $alias);
        } elseif ($escape) {
            $this->SELECT[] = $this->esc($column . ($alias ? ' ' . $alias : ''));
        } else {
            $this->SELECT[] = $column . ($alias ? ' ' . $alias : '');
        }
    }
    
    public function getClause()
    {
        return $this->SELECT;
    }
    
    public function getCompiled()
    {
        if (empty($this->SELECT)) {
            return '*';
        } else {
            if (1 == count($this->SELECT) && 0 == strcasecmp('distinct', $this->SELECT[0])) $this->SELECT[0] = 'DISTINCT *';
            if (0 == strcasecmp('distinct', $this->SELECT[0])) $this->SELECT[0] = 'DISTINCT ' . $this->SELECT[0];
            return implode(', ', array_map(function ($s) { return trim($s); }, $this->SELECT));
        }
    }
}