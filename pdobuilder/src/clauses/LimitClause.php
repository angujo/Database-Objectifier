<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:48 PM
 */

namespace pdobuilder\clause;

class LimitClause extends QueryBuilder implements StatementClause
{
    private $LIMIT = [NULL, NULL];
    
    function limit($length, $offset = 0)
    {
        $this->LIMIT = [(int)$length, (int)$offset];
    }
    
    public function getClause()
    {
        return $this->LIMIT;
    }
    
    public function getCompiled()
    {
        if (NULL === $this->LIMIT[0]) return '';
        return $this->LIMIT[1] . (NULL !== $this->LIMIT[1] ? ', ' . $this->LIMIT[0] : '');
    }
}