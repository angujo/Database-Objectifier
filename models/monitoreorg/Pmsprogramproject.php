<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setProgramId(int  $program_id);
 * @method $this setProjectId(int  $project_id);
 * @method int  getId();
 * @method int  getProgramId();
 * @method int  getProjectId();
 */
class Pmsprogramproject extends Database\DbActive{

    CONST TABLE_NAME = 'pms_program_project';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'program_id' => ['type'=>'int', 'label' => 'Program Id', 'unique' => FALSE, 'required' => FALSE], 'project_id' => ['type'=>'int', 'label' => 'Project Id', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Program Id
     * int(10) unsigned
     * @var int 
     */
    public $program_id;

    /**
     * Project Id
     * int(10) unsigned
     * @var int 
     */
    public $project_id;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsprogramproject
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:09 UTC
 */

