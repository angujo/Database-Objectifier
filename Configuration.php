<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuration
 *
 * @author bangujo
 */
class Configuration {

    static $MODELS_DIRECTORY = 'models' . DIRECTORY_SEPARATOR;
    static $DB_USERNAME = 'ictdev';
    static $DB_NAME = 'redcap';
    static $DB_PASS = 'ictP@ss';
    static $DB_HOST = 'keklf-mysqluat';
    static $DB_SERVER = 'mysql';
    private static $DB_FOLDER = false;

    const TAB = '    ';

    static function dbDirectoryName() {
        if (self::$DB_FOLDER) {
            return self::$DB_FOLDER;
        }
        return self::$DB_FOLDER = trim(strtolower(preg_replace("/[^a-zA-Z0-9]/", "", self::$DB_NAME)));
    }

    static function dbNamespace() {
        return ucfirst(strtolower(self::dbDirectoryName()));
    }

}
