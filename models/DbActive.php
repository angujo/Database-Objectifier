<?php
/**
 * Created by PhpStorm.
 * User: Angujo Barrack
 * Date: 26-Oct-16
 * Time: 6:47 PM
 */

namespace Database;

use pdobuilder\PdoBuilder;

/**
 * Class DbActive
 * @package Database
 */
abstract class DbActive
{
    CONST TABLE_NAME = '';
    CONST DB_NAME    = '';
    
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
    
    /**
     * @param array $details
     *
     * @param bool  $append
     *
     * @param bool  $DBLoad
     *
     * @return $this
     */
    public function init(array $details, $append = TRUE, $DBLoad = FALSE)
    {
        if ($details) {
            if (!is_array($details)) {
                $details = ['id' => (int)$details];
            }
        }
        $v    = get_object_vars($this);
        $vars = array_intersect_key($details, $v);
        if (TRUE !== $append) {
            foreach ($v as $var => $val) {
                $this->$var = NULL;
            }
        }
        foreach ($vars as $property => $val) {
            $this->{$property} = $val;
        }
        if (TRUE === $DBLoad) {
            $v = get_object_vars($this);
            foreach ($v as $column => $val) {
                if (is_null($val)) continue;
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
        $this->init($conditions, FALSE, TRUE);
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
     * @param null $limit
     * @param int  $start
     *
     * @return static[]
     */
    public function all($limit = NULL, $start = 0)
    {
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
        $id       = $this->PDOBuild->table(self::TABLE_NAME)->insert(array_filter(get_object_vars($this)));
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
        if (!isset($this->id) || !$this->id || !$this->one($conditions)) return 0;
        $this->init($conditions, TRUE, TRUE);
        return $this->PDOBuild->table(self::TABLE_NAME)->delete();
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
        return $this->PDOBuild->table(self::TABLE_NAME)->update();
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