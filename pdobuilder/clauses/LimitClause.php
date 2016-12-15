<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 14-Dec-16
 * Time: 7:48 PM
 */

namespace pdobuilder\clause;

class LimitClause extends QueryBuilder
{
    function limit($length, $offset = 0)
    {
        self::$LIMIT = [(int)$length, (int)$offset];
    }
}