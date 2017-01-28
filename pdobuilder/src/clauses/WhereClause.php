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
    private        $WHERE       = [];
    private static $LIKE_BOTH   = 0;
    private static $LIKE_BEFORE = 1;
    private static $LIKE_AFTER  = 2;
    
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
    
    public function where($column, $value = FALSE, $comparison = '=')
    {
        $args = func_get_args();
        array_unshift($args, self::$LIKE_BOTH, FALSE);
        call_user_func_array([$this, '_where'], $args);
        return $this;
    }
    
    private function _where($likePosition, $isOr, $column, $value = FALSE, $comparison = '=')
    {
        if (is_array($column) || is_array($value)) {
            call_user_func_array([$this, 'arrayWhere'], func_get_args());
            return;
        }
        $comparison = in_array(trim(strtoupper($comparison)), $this->comparison) ? strtoupper(trim($comparison)) : '=';
        if (is_null($value)) {
            if ($isOr) $this->orWhereNull($column); else $this->whereNull($column);
        } else {
            if (0 == strcasecmp($comparison, 'like') || 0 == strcasecmp($comparison, 'not like')) {
                $value = ($likePosition == self::$LIKE_AFTER ? '' : '%') . $value . ($likePosition == self::$LIKE_BEFORE ? '' : '%');
            }
            $this->addWhere($column, $comparison . ' ' . $this->valueBind($value), $isOr);
        }
    }
    
    private function arrayWhere($likePosition, $isOR, $column, $value = FALSE, $comparison = '=')
    {
        $args = func_get_args();
        if (is_array($column) && 3 == count($args)) {
            foreach ($column as $col => $val) {
                if (is_string($col)) {
                    if ($isOR) $this->orWhere($col, $val); else $this->where($col, $val);
                } elseif (is_array($val) && 3 == count($val)) {
                    $val = array_values($val);
                    if ($isOR) $this->orWhere($val[0], $val[1], $val[2]); else $this->where($val[0], $val[1], $val[2]);
                }
            }
        } elseif (is_array($column) && 4 <= count($args) && (is_string($value) || is_numeric($value))) {
            $comparison = strtolower(trim($comparison));
            if (0 == strcasecmp($comparison, 'like') || 0 == strcasecmp($comparison, 'not like')) {
                $value  = ($likePosition == self::$LIKE_AFTER ? '' : '%') . $value . ($likePosition == self::$LIKE_BEFORE ? '' : '%');
                $column = 'CONCAT(' . implode(', ', array_filter($column, function ($c) { return is_string($c); })) . ')';
                $value  = ((0 == strcasecmp($comparison, 'like')) ? 'LIKE' : 'NOT LIKE') . ' ' . $this->valueBind( $value );
                $this->addWhere($column, $value, $isOR);
            } else {
                $this->addWhere($this->valueBind($value), 'IN (' . implode(', ', $column) . ')', $isOR);
            }
        } elseif (is_array($value) && is_string($column)) {
            $value = array_filter($value, function ($v) { return is_string($v) || is_numeric($v); });
            if (0 == strcasecmp($comparison, 'like') || 0 == strcasecmp($comparison, 'not like')) {
                $value = ((0 == strcasecmp($comparison, 'like')) ? 'REGEXP' : 'NOT REGEXP') . ' ' . $this->valueBind(implode('|', $value));
            } else {
                $value = 'IN (' . implode(', ', array_map(function ($v) { return $this->valueBind($v); }, $value)) . ')';
            }
            $this->addWhere($column, $value);
        }
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
    
    public function orWhere($column, $value = FALSE, $comparison = '=')
    {
        $args = func_get_args();
        array_unshift($args, self::$LIKE_BOTH, TRUE);
        call_user_func_array([$this, '_where'], $args);
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
        $this->WHERE[] = [$isOR ? 'OR' : 'AND', $this->whereColumn($column) . ' ' . $condition];
    }
    
    public function like($column, $value = NULL, $position = 'both')
    {
        return $this->_like(('before' == $position ? self::$LIKE_BEFORE : ('after' == $position ? self::$LIKE_AFTER : self::$LIKE_BOTH)), FALSE, $column, $value, 'like');
    }
    
    public function orLike($column, $value = NULL, $position = 'both')
    {
        return $this->_like(('before' == $position ? self::$LIKE_BEFORE : ('after' == $position ? self::$LIKE_AFTER : self::$LIKE_BOTH)), TRUE, $column, $value, 'like');
    }
    
    public function notLike($column, $value = NULL, $position = 'both')
    {
        return $this->_like(('before' == $position ? self::$LIKE_BEFORE : ('after' == $position ? self::$LIKE_AFTER : self::$LIKE_BOTH)), FALSE, $column, $value, 'not like');
    }
    
    public function orNotLike($column, $value = NULL, $position = 'both')
    {
        return $this->_like(('before' == $position ? self::$LIKE_BEFORE : ('after' == $position ? self::$LIKE_AFTER : self::$LIKE_BOTH)), TRUE, $column, $value, 'not like');
    }
    
    private function _like($position, $isOR, $column, $value = FALSE, $comparison = 'like')
    {
        call_user_func_array([$this, '_where'], func_get_args());
        return $this;
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
                $where .= ($where ? ' ' . $whereC[0] . ' ' : '');
            }
            $where .= $whereC[1];
            $bracket = '(' == $whereC[1];
        }
        return $where;
    }
}