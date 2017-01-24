<?php
include_once 'src\autoloader.php';

/**
 * Created by PhpStorm.
 * User: bangujo
 * Date: 15/12/2016
 * Time: 04:30 PM
 */
class Actor
{
    public $first_name;
    public $last_name;
    public $last_update;
    public $actor_id;
    
    public function __toString()
    {
        return implode(', ', [$this->first_name, $this->last_name, $this->last_update, $this->actor_id]);
    }
}

$pdb = new \pdobuilder\PdoBuilder();

$actors = $pdb->limit(5)->tableSelect('actor', ['first_name', 'last_name', 'actor_id'])->table('actor')->getAll('Actor');


foreach ($actors as $actor) {
    //var_dump($actor);
}

$films = $pdb->table('film', 'f')->tableSelect('f', ['title', 'description', 'release_year', 'film_id'])->limit(50, 10)->getAll('class');
?>
    <table>
        <thead>
        <tr>
            <th>Film Name</th>
            <th>Description</th>
            <th>Actors</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($films as $film) {
            $actors = $pdb->table('actor', 'a')->where('fa.film_id', $film->film_id)->joinInner('film_actor fa', 'a.actor_id = fa.actor_id')->getAll('Actor');
            // echo $pdb->lastQuery();
            ?>
            <tr>
                <td><?= $film->title, ' (<small><i>', $film->release_year, '</i></small>)'; ?></td>
                <td><?= $film->description; ?></td>
                <td>
                    <ol>
                        <?php foreach ($actors as $actor) {
                            echo '<li>', $actor->last_name, ' ', $actor->first_name, '</li>';
                        } ?>
                    </ol>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php

/*
$q = $pdb->table('actor', 'acr')->columnValue('acr.first_name', 'JJ')->tableColumnValue('acr', ['first_name' => 'John', 'last_name' => 'Doe', 'last_update' => date('Y-m-d')])
    ->where('id', 200)->insertQuery(['fname', 'lname', 'sname']);

echo '<pre>';
print_r($q);*/

/*
//$q   = $pdb->between('names', 90898, 0.8986)->orBetween('names', 9089, 2100)->table('tableXYS')->orGroupStart()->where('col123', "named here")->where('colxyz', "named here")->groupEnd()->selectQuery();
$q2 = $pdb->table('actor', 'acr')->joinLeft('film_actor fa', 'fa.actor_id = acr.actor_id')->select('acr.*, fa.last_update fa_updated, fa.film_id')
    ->orderBy('fa.film_id', 'desc')->limit(10)->getAll('class');
$cs = $pdb->columnsCount();
//$q2['Just']='Am I visible';
echo count($q2);
echo '<pre>';
if ($q2) {
    foreach ($q2 as $item) {
        print_r($item);
    }
} else {
    echo 'NO ROWS!';
}
//var_dump($q2, $pdb->lastQuery(),$cs);*/