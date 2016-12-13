<?php

namespace pdobuilder;
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 13/12/2016
 * Time: 11:38 AM
 */
class QueryClauses
{
    protected static $operators  = ['>' => 'greater', '<' => 'less', '<=' => 'lessequal', '>=' => 'greatequal', '!=' => 'notequal', 'IN' => 'in', 'NOT IN' => 'notin', '=' => ''];
    protected static $connectors = ['OR' => 'or', 'AND' => ''];
}