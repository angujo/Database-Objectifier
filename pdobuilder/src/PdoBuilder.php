<?php
namespace pdobuilder;

/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 13/12/2016
 * Time: 11:21 AM
 */
use pdobuilder\clause\ClausesMerge;
use pdobuilder\statement\Read;

/**
 * Class PdoBuilder
 */
class PdoBuilder extends PDOObject
{
    private $count = 0;
    /** @var PdoBuilder */
    private static $SINGLE = NULL;
    
    function __construct($connectionName = '') { parent::__construct($connectionName); }
    
    function __call($name, $arguments)
    {
        if (NULL === $this->CLAUSE) $this->CLAUSE = new QueryClause();
        if (NULL === call_user_func_array([$this->CLAUSE, $name], $arguments)) ;
        return $this;
    }
    
    /**
     * @param $tableName
     *
     * @return \pdobuilder\PdoBuilder
     */
    static function primaryTable($tableName)
    {
        if (NULL === self::$SINGLE) $cl = new PdoBuilder();
        $cl->table($tableName);
        self::$SINGLE = $cl;
        return self::$SINGLE;
    }
    
    
    function selectQuery($clear = TRUE)
    {
        $read = new Read((new ClausesMerge($this->CLAUSE)));
        $q    = $read->getQuery();
        if ($clear)
            $this->CLAUSE = NULL;
        return $q;
    }
}