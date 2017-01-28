<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 21/12/2016
 * Time: 05:14 PM
 */

namespace pdobuilder;

use pdobuilder\statement\StatementData;

class PhpPdo
{
    /** @var string Identify current PDO connection. */
    private $id = '';
    /** @var \PDO array */
    private static $PDOs = [];
    /** @var \PDOStatement null */
    private $STMT  = NULL;
    private $class = '';
    public  $message;
    public  $code;
    private $error;
    
    public function __construct(array $connection)
    {
        $d   = [];
        $dsn = $connection['type'] . ':';
        $d[] = @$connection['host'] ? 'host=' . $connection['host'] : '';
        $d[] = @$connection['dbname'] ? 'dbname=' . $connection['dbname'] : '';
        $d[] = @$connection['charset'] ? 'charset=' . $connection['charset'] : '';
        $d[] = @$connection['port'] ? 'port=' . $connection['port'] : '';
        $d[] = @$connection['unix_socket'] ? 'unix_socket=' . $connection['unix_socket'] : '';
        $dsn .= implode(';', array_filter($d));
        $this->error = new DBException();
        $this->error->clear();
        
        $this->id = md5($dsn . $connection['username'] . $connection['password']);
        try {
            if (!isset(self::$PDOs[$this->id]))
                self::$PDOs[$this->id] = new \PDO($dsn, $connection['username'], $connection['password'], [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,]);
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
    }
    
    private function preparedBinds($stmt, array $binds)
    {
        $b = [];
        foreach ($binds as $pl => $bind) {
            if (FALSE !== stripos($stmt, $pl)) {
                $b[$pl] = $bind;
            }
        }
        return $b;
    }
    
    private function bind(array $binds)
    {
        try {
            foreach ($binds as $bind => $value) {
                if (is_int($value)) {
                    $this->STMT->bindValue($bind, $value, \PDO::PARAM_INT);
                } elseif (NULL === $value) {
                    $this->STMT->bindValue($bind, $value, \PDO::PARAM_NULL);
                } elseif (FALSE === $value || TRUE === $value) {
                    $this->STMT->bindValue($bind, $value, \PDO::PARAM_BOOL);
                } else $this->STMT->bindValue($bind, $value);
            }
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
    }
    
    public function affectedRows()
    {
        try {
            return $this->STMT->rowCount();
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
        return 0;
    }
    
    public function lastInsertID()
    {
        try {
            return self::$PDOs[$this->id]->lastInsertId();
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
        return NULL;
    }
    
    public function query($sqlQuery, array $parameters = [], $className = '')
    {
        $this->error->clear();
        try {
            $this->class = '';
            $this->STMT  = self::$PDOs[$this->id]->prepare($sqlQuery);
            if ($className = trim($className)) {
                if (!class_exists($className)) {
                    $className = 'stdClass';
                }
                $this->STMT->setFetchMode(\PDO::FETCH_CLASS, $className);
                $this->class = $className;
            }
            $this->bind($this->preparedBinds($sqlQuery, $parameters));
            $this->STMT->execute();
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
    }
    
    public function countCols()
    {
        try {
            return $this->STMT->columnCount();
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
        return NULL;
    }
    
    public function rows()
    {
        try {
            if ($this->class) return new StatementData($this->STMT->fetchAll(\PDO::FETCH_CLASS, $this->class));
            return new StatementData($this->STMT->fetchAll(\PDO::FETCH_ASSOC));
        } catch (\PDOException $PDOBException) {
            $this->error->setException($PDOBException);
        } catch (\PDOBException $exception) {
            $this->error->setException($exception);
        }
        return NULL;
    }
}