<?php
namespace pdobuilder\clause;

/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 6:54 PM
 */
class WhereClause extends QueryBuilder implements StatementClause
{
    private $WHERE = [];
    
    public function groupStart()
    {
        $this->WHERE[] = ['AND', '('];
        return $this;
    }
    
    public function orGroupStart()
    {
        $this->WHERE[] = ['OR', '('];
        return $this;
    }
    
    public function groupEnd()
    {
        $this->WHERE[] = ['', ')'];
        return $this;
    }
    
    public function where($column, $value = NULL)
    {
        if (is_array($column)) {
            $column = array_filter($column, function ($c) { return (bool)trim($c); });
            foreach ($column as $col => $item) {
                $this->where($col, $item);
            }
            return $this;
        }
        if (NULL === $value || FALSE === $value) return $this->whereNull($column);
        $this->addWhere($column, ' = ' . $this->valueBind($value));
        return $this;
    }
    
    public function whereNull($column)
    {
        if (!trim($column)) return $this;
        $this->addWhere($column, ' IS NULL');
        return $this;
    }
    
    public function whereNotNull($column)
    {
        if (!trim($column)) return $this;
        $this->addWhere($column, ' IS NOT NULL');
        return $this;
    }
    
    public function whereIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addWhere($column, ' IN (' . implode(', ', $this->arrayBind($values)) . ')');
        return $this;
    }
    
    public function whereNotIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addWhere($column, ' NOT IN (' . implode(', ', $this->arrayBind($values)) . ')');
        return $this;
    }
    
    public function orWhere($column, $value = NULL)
    {
        if (is_array($column)) {
            $column = array_filter($column, function ($c) { return (bool)trim($c); });
            foreach ($column as $col => $item) {
                $this->where($col, $item);
            }
            return $this;
        }
        if (NULL === $value || FALSE === $value) return $this->whereNull($column);
        $this->addWhere($column, ' = ' . $this->valueBind($value), TRUE);
        return $this;
    }
    
    public function orWhereNull($column)
    {
        if (!trim($column)) return $this;
        $this->addWhere($column, ' IS NULL', TRUE);
        return $this;
    }
    
    public function orWhereNotNull($column)
    {
        if (!trim($column)) return $this;
        $this->addWhere($column, ' IS NOT NULL', TRUE);
        return $this;
    }
    
    public function orWhereIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addWhere($column, ' IN (' . implode(', ', $this->arrayBind($values)) . ')', TRUE);
        return $this;
    }
    
    public function orWhereNotIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addWhere($column, ' NOT IN (' . implode(', ', $this->arrayBind($values)) . ')', TRUE);
        return $this;
    }
    
    private function whereColumn($column)
    {
        $column = array_filter(explode(' ', trim($column)), function ($c) { return (bool)trim($c); });
        return $this->esc(implode(' ', $column));
    }
    
    private function addWhere($column, $condition, $isOR = FALSE)
    {
        $this->WHERE[] = [$isOR ? 'OR' : 'AND', $this->whereColumn($column) . $condition];
    }
    
    public function getClause()
    {
        return $this->WHERE;
    }
    
    public function getCompiled()
    {
        $where   = '';
        $bracket = FALSE;
        foreach ($this->WHERE as $whereC) {
            if (!$bracket) {
                $where .= ($where ? ' ' . $whereC[0].' ' : '');
            }
            $where .= $whereC[1];
            $bracket = '(' == $whereC[1];
        }
        return $where;
    }
}