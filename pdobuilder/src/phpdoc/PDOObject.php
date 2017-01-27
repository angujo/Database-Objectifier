<?php
namespace pdobuilder;

/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 04:51 PM
 */
use pdobuilder\clause\ClausesMerge;
use pdobuilder\clause\QueryBuilder;
use pdobuilder\statement\Delete;
use pdobuilder\statement\Read;
use pdobuilder\statement\Update;

/**
 * Class PDOObject
 * @method $this orderBy($column, $order = "ASC");
 * @method $this limit($length, $offset = 0);
 * @method $this select($column, $alias = NULL, $escape = TRUE);
 * @method $this tableSelect($tableName, array $column);
 * @method $this table($tableName, $alias = NULL);
 * @method $this betweenDates($column, $min, $max);
 * @method $this orBetweenDates($column, $min, $max);
 * @method $this between($column, $min, $max, $escape = FALSE);
 * @method $this orBetween($column, $min, $max, $escape = FALSE);
 * @method $this groupBy($column);
 * @method $this having($column, $value = NULL);
 * @method $this orHaving($column, $value = NULL);
 * @method $this havingIn($column, array $values);
 * @method $this orHavingIn($column, array $values);
 * @method $this havingNotIn($column, array $values);
 * @method $this orHavingNotIn($column, array $values);
 * @method $this groupStart();
 * @method $this orGroupStart();
 * @method $this groupEnd();
 * @method $this orWhere($column, $values = NULL);
 * @method $this orWhereNull($column);
 * @method $this orWhereNotNull($column);
 * @method $this orWhereIn($column, array $values = NULL);
 * @method $this orWhereNotIn($column, array $values = NULL);
 * @method $this where($column, $values = NULL);
 * @method $this whereNull($column);
 * @method $this whereNotNull($column);
 * @method $this whereIn($column, array $values = NULL);
 * @method $this whereNotIn($column, array $values = NULL);
 * @method $this join($table, $condition, $joinType = 'LEFT');
 * @method $this joinLeft($table, $condition);
 * @method $this joinRight($table, $condition);
 * @method $this joinOuter($table, $condition);
 * @method $this joinInner($table, $condition);
 * @method $this columnValue($column, $value = NULL, $escape = FALSE);
 * @method $this tableColumnValue($tableName, $column, $value = NULL, $escape = FALSE);
 */
class PDOObject
{
    protected $CLAUSE;
    protected $PDO;
    protected $last_query = '';
    protected $READ       = NULL;
    
    function __construct($connection)
    {
        if (is_array($connection)) {
            $_connections = $connection;
        } elseif (is_string($connection) || is_numeric($connection)) {
            $connection  = trim($connection) ?: 'default';
            $connections = include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'conf.php';
            if (!isset($connections[$connection])) throw new \Exception('Invalid connection!');
            $_connections = $connections[$connection];
        } else throw new \Exception('Invalid connection Data Type!');
        $this->PDO    = new PhpPdo($_connections);
        $this->CLAUSE = new QueryClause();
    }
    
    public function delete($aliases = NULL)
    {
        $delete           = new Delete((new ClausesMerge($this->CLAUSE)), $aliases);
        $this->CLAUSE     = NULL;
        $this->last_query = $delete->getQuery();
        $this->PDO->query($delete->getRaw(), QueryBuilder::$PARAMETERS);
        return $this->PDO->affectedRows();
    }
    
    public function update($tableName = NULL, array $columns = [])
    {
        if ($tableName && is_array($tableName)) {
            $columns = $tableName;
        } elseif ($tableName && (is_string($tableName) || is_numeric($tableName))) {
            $this->CLAUSE->table($tableName);
        }
        $this->CLAUSE->columnValue($columns);
        $update           = new Update((new ClausesMerge($this->CLAUSE, QueryBuilder::COMPILE_EQUATE)));
        $this->CLAUSE     = NULL;
        $this->last_query = $update->getQuery();
        $this->PDO->query($update->getRaw(), QueryBuilder::$PARAMETERS);
        return $this->PDO->affectedRows();
    }
    
    private function reader()
    {
        $this->READ       = new Read((new ClausesMerge($this->CLAUSE)));
        $q                = $this->READ->getRaw();
        $this->last_query = $this->READ->getQuery();
        $this->CLAUSE     = NULL;
        return $q;
    }
    
    function count()
    {
        $this->CLAUSE->select(NULL);
        $this->CLAUSE->select('COUNT(*) numrows');
        $this->CLAUSE->limit(1);
        $this->PDO->query($this->reader(), QueryBuilder::$PARAMETERS);
        $r = $this->PDO->rows()->first();
        return (int)@$r['numrows'];
    }
    
    function columnsCount()
    {
        if (!$this->READ) return [];
        return $this->PDO->countCols();
    }
    
    function columns()
    {
        if (!$this->READ) return [];
        return array_keys($this->PDO->rows()->first() ?: []);
    }
    
    function getOne($className = '')
    {
        $this->CLAUSE->limit(1);
        $this->PDO->query($this->reader(), QueryBuilder::$PARAMETERS, $className);
        return $this->PDO->rows()->first();
    }
    
    function getAll($className = '')
    {
        $this->PDO->query($this->reader(), QueryBuilder::$PARAMETERS, $className);
        return $this->PDO->rows();
    }
    
    function lastQuery() { return $this->last_query; }
}