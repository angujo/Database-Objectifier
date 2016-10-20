<?php

require_once 'factory/Model.php';
require_once 'factory/Extension.php';
require_once 'factory/Table.php';
require_once 'factory/Tablefield.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Configuration.php';
require_once 'Dbobjectifier.php';
//var_dump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models');

$path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models'.DIRECTORY_SEPARATOR.'monitoreorg';
$dirs = glob($path . DIRECTORY_SEPARATOR . '*.{php}', GLOB_BRACE);
echo '<pre>';
var_dump($dirs);

//var_dump(PHP_VERSION);

var_dump(version_compare(PHP_VERSION, '5.6.0', '>'));
$obj = new Dbobjectifier(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);

//$obj->generate();
