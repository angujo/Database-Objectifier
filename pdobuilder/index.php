<?php
include_once 'src\autoloader.php';

/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 04:30 PM
 */
class theClassics
{
    
}

$pdb = new \pdobuilder\PdoBuilder();
//$q   = $pdb->between('names', 90898, 0.8986)->orBetween('names', 9089, 2100)->table('tableXYS')->orGroupStart()->where('col123', "named here")->where('colxyz', "named here")->groupEnd()->selectQuery();
$q2 = $pdb->table('actor', 'acr')->joinLeft('film_actor fa', 'fa.actor_id = acr.actor_id')->select('acr.*, fa.last_update fa_updated, fa.film_id')//->where('acr.actor_id', 'xxxxxxxx')
    ->orderBy('fa.film_id', 'desc')->limit(10)->getAll('class');
$cs = $pdb->columnsCount();
//$q2['Just']='Am I visible';
echo count($q2);
echo '<pre>';
if($q2){
    foreach ($q2 as $item) {
        print_r($item);
    }
}else{
    echo 'NO ROWS!';
}
//var_dump($q2, $pdb->lastQuery(),$cs);