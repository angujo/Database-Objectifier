<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dbobjectifier
 *
 * @author bangujo
 */
class Dbobjectifier
{
    
    private $PDO             = NULL;
    private $tableReferences = [];
    private $tableRefers     = [];
    
    function __construct()
    {
        try {
            $this->PDO =
                new PDO(Configuration::$DB_SERVER . ':host=' . Configuration::$DB_HOST . ';dbname=' . Configuration::$DB_NAME . ';charset=utf8',
                        Configuration::$DB_USERNAME, Configuration::$DB_PASS);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            die();
        }
    }
    
    private function getReferences($tableName)
    {
        if (isset($this->tableReferences[$tableName])) return $this->tableReferences[$tableName];
        $this->tableReferences[$tableName]['top']    = $this->getReferencer($tableName);
        $this->tableReferences[$tableName]['bottom'] = $this->getReferencesx($tableName);
        return $this->tableReferences[$tableName];
    }
    
    private function getReferencesx($tableName)
    {
        $theTable = [];
        $q        =
            'SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = \'' .
            Configuration::$DB_NAME . '\' AND REFERENCED_TABLE_NAME = \'' . $tableName . '\' AND REFERENCED_COLUMN_NAME IS NOT NULL';
        //echo $q,':::RUNNING<p>';
        $stmt = $this->PDO->query($q);
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $row) {
            if($row['TABLE_NAME']==$row['REFERENCED_TABLE_NAME']) continue;
            $r             = ['column'            => $row['COLUMN_NAME'], 'table' => $row['TABLE_NAME'],
                              'referenced_column' => $row['REFERENCED_COLUMN_NAME'],
                              'referenced_table'  => $row['REFERENCED_TABLE_NAME']];
            $r['children'] = $this->getReferencesx($row['TABLE_NAME']);
            
            $theTable[] = (object)$r;
        }
        return $theTable;
    }
    
    private function getReferencer($tableName)
    {
        $theTable = [];
        $q        =
            'SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM information_schema.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = \'' .
            Configuration::$DB_NAME . '\' AND TABLE_NAME = \'' . $tableName . '\' AND REFERENCED_COLUMN_NAME IS NOT NULL';
        //echo $tableName,' => ',$q,'<p>';
        $stmt = $this->PDO->query($q);
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $row) {
            //Self referencing tables are skipped.
            if($row['TABLE_NAME']==$row['REFERENCED_TABLE_NAME']) continue;
            $r             = ['column'            => $row['COLUMN_NAME'], 'table' => $row['TABLE_NAME'],
                              'referenced_column' => $row['REFERENCED_COLUMN_NAME'],
                              'referenced_table'  => $row['REFERENCED_TABLE_NAME']];
            $r['children'] = $r['table'] == $r['referenced_table'] ? [] : $this->getReferencer($row['REFERENCED_TABLE_NAME']);
            
            $theTable[] = (object)$r;
        }
        return $theTable;
    }
    
    private function databaseExist()
    {
        $stmt = $this->PDO->query('SHOW DATABASES WHERE `Database` LIKE \'' . Configuration::$DB_NAME . '\'');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
            throw new Exception('Missing Database! Ensure DB Exists!');
        }
        return TRUE;
    }
    
    /**
     *
     * @return \Table[]
     */
    private function getTables()
    {
        $stmt = $this->PDO->query('SHOW FULL TABLES FROM `' . Configuration::$DB_NAME . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $tables = [];
        $tbs    = $stmt->fetchAll(PDO::FETCH_NUM);
        foreach ($tbs as $row) {
            $tables[] = new Table($row[0], $this->getTableFields($row[0]), $row[1]);
        }
        /**
         * Give each table 30 seconds to process and create its model.
         */
        ini_set('max_execution_time', (30 * count($tables)));
        return $tables;
    }
    
    /**
     *
     * @param string $tableName
     *
     * @return \Tablefield[]
     */
    private function getTableFields($tableName)
    {
        $stmt = $this->PDO->query('SHOW FULL COLUMNS FROM `' . $tableName . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $columns = [];
        $cols    = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $row) {
            $columns[] = new Tablefield($row);
        }
        return $columns;
    }
    
    function generate()
    {
        $this->databaseExist();
        $tables = $this->getTables();
        foreach ($tables as $table) {
            //$this->getReferencer($table->name)
            $m = new Model($table);
            $m->generate($this->getReferences($table->name));
            /*if ($refs) {
                $e = new Extension($table, $constArgs);
                $e->generate($refs);
            }*/
        }
        echo '<pre>';
        //print_r($this->tableReferences);
        //var_dump($this->tableReferences);
        echo '</pre>';
    }
    
}
