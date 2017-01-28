<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 27/01/2017
 * Time: 06:47 PM
 */

namespace pdobuilder;


class DBException
{
    private static $code;
    private static $message;
    /** @var  \Exception */
    private static $exception;
    
    static function getCode() { return self::$exception ? self::$exception->getCode() : NULL; }
    
    static function getMessage() { return self::$exception ? self::$exception->getMessage() : NULL; }
    
    public function setException(\Exception $exception) { self::$exception = $exception; }
    
    public function clear() { self::$exception = NULL; }
}