<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 27/01/2017
 * Time: 09:38 AM
 */

spl_autoload_register(function ($n) {
    $dirs = [dirname(__FILE__) . DIRECTORY_SEPARATOR . 'pdobuilder', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'models'];
    autoLoad($n, $dirs);
});

function autoLoad($name, $dir = NULL)
{
    if(is_array($dir)){
        foreach ($dir as $path) {
            if (autoLoad($name, $path)) return TRUE;
        }
        return FALSE;
    }
    $name = explode('\\', $name);
    $name = $name[count($name) - 1];
    $dir  = !$dir ? dirname(__FILE__) : $dir;
    if (file_exists($dir . DIRECTORY_SEPARATOR . $name . '.php')) {
        include_once $dir . DIRECTORY_SEPARATOR . $name . '.php';
        return TRUE;
    }
    $dirs = glob($dir . DIRECTORY_SEPARATOR . '*', GLOB_ONLYDIR);
    foreach ($dirs as $dir) {
        if (autoLoad($name, $dir)) return TRUE;
    }
    return FALSE;
}