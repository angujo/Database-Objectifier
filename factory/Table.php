<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Table
 *
 * @author bangujo
 */
class Table
{
    
    public  $name     = '';
    private $fields   = [];
    public  $model    = '';
    public  $comment  = '';
    public  $typeView = FALSE;
    
    /**
     * Table constructor.
     *
     * @param string       $name
     * @param Tablefield[] $fields
     * @param string       $type
     */
    public function __construct($name = '', array $fields = [], $type = '')
    {
        $this->name     = $name;
        $this->typeView = 'view' == trim(strtolower($type));
        $this->model    = English::entityName($name,TRUE);//ucfirst(strtolower(trim(preg_replace("/[^a-zA-Z0-9]/", "", $name))));
        $this->fields   = $fields;
    }
    
    /**
     * @return array|Tablefield[]
     */
    public function getFields()
    {
        return $this->fields;
    }
}
