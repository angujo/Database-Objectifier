<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:11 PM
 */

namespace pdobuilder\clause;

class HavingClause extends QueryBuilder
{
    public function having($column, $value = NULL)
    {
        if (is_array($column)) {
            $column = array_filter($column, function ($c) { return (bool)trim($c); });
            foreach ($column as $col => $item) {
                if (is_array($col)) continue;
                $this->having($col, $item);
            }
            return $this;
        }
        if (NULL === $value || FALSE === $value) return $this;
        $this->addHaving($column, ' = ' . $this->valueBind($value));
        return $this;
    }
    
    public function havingIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addHaving($column, ' IN (' . implode(', ', $this->arrayBind($values)) . ')');
        return $this;
    }
    
    public function havingNotIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addHaving($column, ' NOT IN (' . implode(', ', $this->arrayBind($values)) . ')');
        return $this;
    }
    
    public function orHaving($column, $value = NULL)
    {
        if (is_array($column)) {
            $column = array_filter($column, function ($c) { return (bool)trim($c); });
            foreach ($column as $col => $item) {
                $this->having($col, $item);
            }
            return $this;
        }
        if (NULL === $value || FALSE === $value) return $this;
        $this->addHaving($column, ' = ' . $this->valueBind($value), TRUE);
        return $this;
    }
    
    public function orHavingIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addHaving($column, ' IN (' . implode(', ', $this->arrayBind($values)) . ')', TRUE);
        return $this;
    }
    
    public function orHavingNotIn($column, array $values)
    {
        if (!$values = array_filter($values)) return $this;
        $this->addHaving($column, ' NOT IN (' . implode(', ', $this->arrayBind($values)) . ')', TRUE);
        return $this;
    }
    
    private function havingColumn($column)
    {
        $column = array_filter(explode(' ', trim($column)), function ($c) { return (bool)trim($c); });
        return $this->esc(implode(' ', $column));
    }
    
    private function addHaving($column, $condition, $isOR = FALSE)
    {
        self::$HAVING[] = [$isOR ? 'OR' : 'AND', $this->havingColumn($column) . $condition];
    }
}