<?php
/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 02:47 PM
 */

namespace pdobuilder\clause;


interface StatementClause
{
    public function getClause();
    
    public function getCompiled();
}