<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 14/12/2016
 * Time: 08:36 AM
 */

spl_autoload_register(function ($n) { autoLoad($n); });

function autoLoad($name, $dir = NULL)
{
    $name = explode('\\', $name);
    $name = $name[count($name) - 1];
    $dir  = !$dir ? dirname(__FILE__) : $dir;
    if (file_exists($dir . DIRECTORY_SEPARATOR . $name . '.php')) {
        include_once $dir . DIRECTORY_SEPARATOR . $name . '.php';
        return TRUE;
    }
    $dirs = glob($dir . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
    foreach ($dirs as $dir) {
        if(autoLoad($name,$dir)) return TRUE;
    }
    return FALSE;
}