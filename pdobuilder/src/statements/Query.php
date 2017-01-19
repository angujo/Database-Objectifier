<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 04:10 PM
 */

namespace pdobuilder\statement;


use pdobuilder\clause\QueryBuilder;

class Query
{
    private $statement = '';
    
    protected function prepareQuery(array $statement = NULL)
    {
        $this->statement = implode(' ', $statement);
        return $statement;
    }
    
    protected function rawQuery(array $statement)
    {
        $this->prepareQuery($statement);
        return $this->statement;
    }
    
    protected function compiledQuery(array $statement)
    {
        $this->prepareQuery($statement);
        foreach (QueryBuilder::$PARAMETERS as $PARAMETER => $VAL) {
            $this->statement = str_ireplace($PARAMETER, (is_numeric($VAL) ? $VAL : "'$VAL'"), $this->statement);
        }
        return $this->statement;
    }
    
    protected function btwnAppend($btwn, $where)
    {
        if ($where) return $btwn;
        return trim(preg_replace('/(OR|AND)/', '', $btwn, 1));
    }
}