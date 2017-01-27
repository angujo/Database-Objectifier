<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 22/12/2016
 * Time: 12:18 PM
 */

namespace pdobuilder\clause;

class ColumnValueClause extends QueryBuilder implements StatementClause
{
    private $COLVAL = [];
    private $tableN = NULL;
    
    public function tableColumnValue($tableName, $column, $value = NULL, $escape = FALSE)
    {
        $this->tableN = $tableName;
        $this->columnValue($column, $value, $escape);
        $this->tableN = NULL;
        return $this;
    }
    
    public function columnValue($column, $value = NULL, $escape = FALSE)
    {
        if (is_array($column)) {
            $column = array_filter($column, function ($c) { return (is_string($c) || is_numeric($c)) && strlen(trim($c)); });
            if (!$column) return $this;
            foreach ($column as $c => $item) {
                if (is_array($item)) {
                    if (2 > count($item)) continue;
                    $i = 0;
                    foreach ($item as $value) {
                        if (!$this->validVar($value) || $i == 3) break;
                        $i++;
                    }
                    $this->addColVal($item[0], $item[1], @$item[2] ?: FALSE);
                } else {
                    $this->addColVal($c, $item, FALSE);
                }
            }
        } else {
            $this->addColVal($column, $value, $escape);
        }
        return $this;
    }
    
    private function addColVal($column, $value, $escape)
    {
        $column                            = NULL !== $this->tableN ? $this->tableN . '.' . $column : $column;
        $this->COLVAL[$this->esc($column)] = FALSE === $escape ? $this->valueBind($value) : $this->esc($value);
    }
    
    public function getClause()
    {
        // TODO: Implement getClause() method.
    }
    
    public function getCompiled($compileType = 0)
    {
        $compiled = [];
        foreach ($this->COLVAL as $column => $value) {
            if ($compileType == self::COMPILE_EQUATE) {
                $compiled[] = $column . ' = ' . $value;
            } elseif ($compileType == self::COMPILE_BOTH) {
                $compiled[0][] = $column;
                $compiled[1][] = $value;
            } else {
                $compiled[] = $value;
            }
        }
        if (self::COMPILE_BOTH == $compileType) {
            return array_map(function ($cv) { return implode(', ', $cv); }, $compiled);
        }
        return implode(', ', $compiled);
    }
}