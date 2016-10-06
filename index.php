<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'Dbobjectifier.php';
var_dump(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models');
$obj = new Dbobjectifier(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR);

$obj->generate();
