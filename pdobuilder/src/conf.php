<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 21/12/2016
 * Time: 04:12 PM
 */
$config            = [];
$config['default'] = [
    'type'        => 'mysql',//mysql | mssql
    'host'        => 'localhost',
    'port'        => '',
    'dbname'      => 'sakila',
    'unix_socket' => '',
    'charset'     => 'utf8',
    'username'    => 'root',
    'password'    => 'root',
];
//....add more
return $config;