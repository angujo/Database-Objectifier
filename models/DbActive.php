<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 26-Oct-16
 * Time: 6:47 PM
 */

namespace Database;

use pdobuilder\PdoBuilder;
use pdobuilder\statement\StatementData;

/**
 * Class DbActive
 * @package Database
 */
abstract class DbActive
{
    CONST TABLE_NAME = '';
    CONST DB_NAME    = '';
    
    private static $ignoreVars = ['pdobuild', 'details'];
    
    /** @var \pdobuilder\PdoBuilder */
    protected $PDOBuild;
    
    public function __construct($conditions = NULL)
    {
        $connections           = include dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'pdobuilder' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'conf.php';
        $connections           = $connections['setting'];
        $connections['dbname'] = static::DB_NAME;
        $this->PDOBuild        = new PdoBuilder($connections);
        $this->init($conditions);
    }
    
    public function lastQuery() { return $this->PDOBuild->lastQuery(); }
    
    /**
     * @param array $details
     *
     * @param bool  $append
     *
     * @param bool  $DBLoad
     *
     * @param bool  $exclusive
     *
     * @return $this
     */
    public function init($details, $append = TRUE, $DBLoad = FALSE, $exclusive = FALSE)
    {
        $details = is_array($details) ? array_filter($details) : $details;
        if ($details) {
            if (!is_array($details)) {
                $details = ['id' => (int)$details];
            }
        }
        if (is_array($details) && $details) {
            $v    = get_object_vars($this);
            $vars = array_intersect_key($details, $v);
            if (TRUE !== $append) {
                foreach ($v as $var => $val) {
                    if (in_array(strtolower(trim($var)), self::$ignoreVars)) continue;
                    $this->$var = NULL;
                }
            }
            foreach ($vars as $property => $val) {
                if (in_array(strtolower(trim($property)), self::$ignoreVars)) continue;
                $this->{$property} = $val;
            }
        }
        if (TRUE === $DBLoad) {
            $v = $exclusive ? (is_array($details) ? $details : []) : get_object_vars($this);
            foreach ($v as $column => $val) {
                if (is_null($val) || in_array(strtolower(trim($column)), self::$ignoreVars)) continue;
                $this->PDOBuild->where($column, $val);
            }
        }
        return $this;
    }
    
    function __call($name, $arguments)
    {
        $sub = substr($name, 0, 3);
        if (in_array($sub, ['set', 'get']) && 3 < strlen($name)) {
            foreach ($this as $prop => $val) {
                $func = $sub . str_ireplace(' ', '', ucwords(str_ireplace('_', ' ', $prop)));
                if ($name == $func) {
                    if ('get' == $sub) {
                        return $val;
                    }
                    if ('set' == $sub) {
                        if (1 <= count($arguments)) {
                            $this->{$prop} = $arguments[0];
                        }
                        return $this;
                    }
                }
            }
        }
        return NULL;
    }
    
    /**
     * @param $conditions
     *
     * @return int
     */
    public function count($conditions = [])
    {
        $this->init($conditions, FALSE, TRUE, TRUE);
        return $this->PDOBuild->table(static::TABLE_NAME)->count();
    }
    
    /**
     * @param array|int|null $conditions
     *
     * @return static
     */
    public function one($conditions = NULL)
    {
        $this->init($conditions, FALSE, TRUE);
        /** @var array $d */
        $d = $this->PDOBuild->limit(1)->table(static::TABLE_NAME)->getOne();
        $this->init($d, FALSE);
        return $d ? $this : NULL;
    }
    
    /**
     * @param array $conditions
     * @param null  $limit
     * @param int   $start
     *
     * @return \pdobuilder\statement\StatementData|static[]
     */
    public function all($conditions = [], $limit = NULL, $start = 0)
    {
        $this->PDOBuild->where($conditions);
        if (!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$start);
        /** @var static[] $d */
        $d = $this->PDOBuild->table(static::TABLE_NAME)->getAll(get_class(new static()));
        return $d;
    }
    
    /**
     * @param array|int|null $variables
     *
     * @return int
     */
    public function insert($variables = NULL)
    {
        $this->id = NULL;
        $this->init($variables, TRUE, FALSE);
        $id       = $this->PDOBuild->table(static::TABLE_NAME)->insert(array_filter(get_object_vars($this)));
        $this->id = $id;
        return $id;
    }
    
    /**
     * @param array|int|null $conditions
     *
     * @return int
     */
    public function delete($conditions = NULL)
    {
        if (((!isset($this->id) || !$this->id) && ((!is_array($conditions) && !is_numeric($conditions)) || (is_array($conditions) && !isset($conditions['id'])))) || !$this->one($conditions)) return 0;
        $this->init($conditions, TRUE, TRUE);
        return $this->PDOBuild->table(static::TABLE_NAME)->delete();
    }
    
    public function softDelete(array $conditions, $identifierColumn = 'id')
    {
        $identifierColumn = !is_string($identifierColumn) ? 'id' : $identifierColumn;
        $entries          = $this->PDOBuild->where($conditions)->table(static::TABLE_NAME)->getAll();
        $c                = 0;
        if ($entries->count()) {
            foreach ($entries as $entry) {
                $d               = [];
                $d['data']       = json_encode($entry);
                $d['name']       = isset($entry[$identifierColumn]) ? $entry[$identifierColumn] : 'id';
                $d['dated']      = date('Y-m-d H:i:s');
                $d['table_name'] = static::TABLE_NAME;
                $d['actionby']   = 1;
                if ($this->PDOBuild->table('trash')->insert($d)) {
                    $c++;
                    $this->PDOBuild->table(static::TABLE_NAME)->where('id', $entry['id'])->delete();
                }
            }
        }
        return (bool)$c;
    }
    
    /**
     * @param array|int|null $conditions
     *
     * @return int
     */
    public function update($conditions = NULL)
    {
        if (!isset($this->id) || !$this->id || !$this->one($conditions)) return 0;
        $this->init($conditions, TRUE, TRUE);
        return $this->PDOBuild->table(static::TABLE_NAME)->update();
    }
    
    /**
     * @param array $updates
     *
     * @param array $conditions
     *
     * @return int
     */
    public function updateAll(array $updates, $conditions = [])
    {
        return $this->PDOBuild->columnValue($updates)->where($conditions)->update(static::TABLE_NAME);
    }
    
    public static function model($pk = NULL)
    {
        return new static($pk);
    }
}