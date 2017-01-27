<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setType(string  $type);
 * @method $this setAssessmentId(int  $assessment_id);
 * @method $this setFileName(string  $file_name);
 * @method $this setStatus(int  $status);
 * @method $this setStartTime(string  $start_time);
 * @method $this setEndTime(string  $end_time);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setLastRun(string  $last_run);
 * @method $this setUpdateRecord(int  $update_record);
 * @method $this setFirstRow(int  $first_row);
 * @method int  getId();
 * @method string  getType();
 * @method int  getAssessmentId();
 * @method string  getFileName();
 * @method int  getStatus();
 * @method string  getStartTime();
 * @method string  getEndTime();
 * @method int  getSupervisorId();
 * @method string  getLastRun();
 * @method int  getUpdateRecord();
 * @method int  getFirstRow();
 */
class Svydataschedules extends Database\DbActive{

    CONST TABLE_NAME = 'svy_data_schedules';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => FALSE], 'assessment_id' => ['type'=>'int', 'label' => 'Assessment Id', 'unique' => FALSE, 'required' => FALSE], 'file_name' => ['type'=>'string', 'label' => 'File Name', 'unique' => FALSE, 'required' => TRUE], 'status' => ['type'=>'int', 'label' => 'Status', 'unique' => FALSE, 'required' => FALSE], 'start_time' => ['type'=>'string', 'label' => 'Start Time', 'unique' => FALSE, 'required' => FALSE], 'end_time' => ['type'=>'string', 'label' => 'End Time', 'unique' => FALSE, 'required' => FALSE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => FALSE], 'last_run' => ['type'=>'string', 'label' => 'Last Run', 'unique' => FALSE, 'required' => FALSE], 'update_record' => ['type'=>'int', 'label' => 'Update Record', 'unique' => FALSE, 'required' => FALSE], 'first_row' => ['type'=>'int', 'label' => 'First Row', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Type
     * enum('import','export')
     * @var string 
     */
    public $type;

    /**
     * Assessment Id
     * int(10) unsigned
     * @var int 
     */
    public $assessment_id;

    /**
     * File Name
     * (Required)
     * varchar(65)
     * @var string 
     */
    public $file_name;

    /**
     * Status
     * tinyint(2)
     * @var int 
     */
    public $status;

    /**
     * Start Time
     * datetime
     * @var string 
     */
    public $start_time;

    /**
     * End Time
     * datetime
     * @var string 
     */
    public $end_time;

    /**
     * Supervisor Id
     * int(10) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Last Run
     * datetime
     * @var string 
     */
    public $last_run;

    /**
     * Update Record
     * tinyint(1)
     * @var int 
     */
    public $update_record;

    /**
     * First Row
     * int(11)
     * @var int 
     */
    public $first_row;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svydataschedules
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

