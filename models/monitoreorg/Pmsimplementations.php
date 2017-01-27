<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setWorkPlanId(int  $work_plan_id);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setName(string  $name);
 * @method $this setSummary(string  $summary);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setReport(string  $report);
 * @method $this setLongitude(float  $longitude);
 * @method $this setLatitude(float  $latitude);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getWorkPlanId();
 * @method int  getStructureId();
 * @method int  getSupervisorId();
 * @method string  getName();
 * @method string  getSummary();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method string  getReport();
 * @method float  getLongitude();
 * @method float  getLatitude();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsimplementations extends Database\DbActive{

    CONST TABLE_NAME = 'pms_implementations';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'work_plan_id' => ['type'=>'int', 'label' => 'Work Plan Id', 'unique' => FALSE, 'required' => TRUE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'summary' => ['type'=>'string', 'label' => 'Summary', 'unique' => FALSE, 'required' => FALSE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => TRUE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => TRUE], 'report' => ['type'=>'string', 'label' => 'Report', 'unique' => FALSE, 'required' => FALSE], 'longitude' => ['type'=>'float', 'label' => 'Longitude', 'unique' => FALSE, 'required' => FALSE], 'latitude' => ['type'=>'float', 'label' => 'Latitude', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Work Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $work_plan_id;

    /**
     * Structure Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Supervisor Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Name
     * varchar(255)
     * @var string 
     */
    public $name;

    /**
     * Summary
     * text
     * @var string 
     */
    public $summary;

    /**
     * Start Date
     * (Required)
     * date
     * @var string 
     */
    public $start_date;

    /**
     * End Date
     * (Required)
     * date
     * @var string 
     */
    public $end_date;

    /**
     * Report
     * text
     * @var string 
     */
    public $report;

    /**
     * Longitude
     * double
     * @var float 
     */
    public $longitude;

    /**
     * Latitude
     * double
     * @var float 
     */
    public $latitude;

    /**
     * Created
     * datetime
     * @var string 
     */
    public $created;

    /**
     * Created By
     * int(11)
     * @var int 
     */
    public $created_by;

    /**
     * Updated
     * datetime
     * @var string 
     */
    public $updated;

    /**
     * Updated By
     * int(11)
     * @var int 
     */
    public $updated_by;

    /**
     * Deleted
     * datetime
     * @var string 
     */
    public $deleted;

    /**
     * Deleted By
     * int(11)
     * @var int 
     */
    public $deleted_by;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsimplementationaccounts[]
     */
    function getPmsimplementationaccounts($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.implementation_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsimplementationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_implementation_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsimplementationaccounts');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.implementation_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsimplementations
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:09 UTC
 */

