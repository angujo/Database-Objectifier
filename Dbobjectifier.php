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
class Dbobjectifier {

    private $PDO = null;

    function __construct() {
        try {
            $this->PDO = new PDO(Configuration::$DB_SERVER . ':host=' . Configuration::$DB_HOST . ';dbname=' . Configuration::$DB_NAME . ';charset=utf8', Configuration::$DB_USERNAME, Configuration::$DB_PASS);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            die();
        }
    }

    private function databaseExist() {
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
    private function getTables() {
        $stmt = $this->PDO->query('SHOW FULL TABLES FROM `' . Configuration::$DB_NAME . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $tables = array();
        $tbs = $stmt->fetchAll(PDO::FETCH_NUM);
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
     * @param type $tableName
     * @return \Tablefield
     */
    private function getTableFields($tableName) {
        $stmt = $this->PDO->query('SHOW FULL COLUMNS FROM `' . $tableName . '`');
        if (!$stmt) {
            var_dump($this->PDO->errorInfo());
            die();
        }
        $columns = array();
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($cols as $row) {
            $columns[] = new Tablefield($row['Field'], $row['Type'], 'no' == trim(strtolower($row['Null'])), $row['Comment']);
        }
        return $columns;
    }

    function generate() {
        $this->databaseExist();
        $tables = $this->getTables();
        foreach ($tables as $table) {
            $m = new Model($table);
            $m->generate();
        }
    }

}
