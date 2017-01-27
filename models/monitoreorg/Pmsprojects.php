<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setLogframeInstanceId(int  $logframe_instance_id);
 * @method $this setDescription(string  $description);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method int  getId();
 * @method string  getName();
 * @method int  getLogframeInstanceId();
 * @method string  getDescription();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 */
class Pmsprojects extends Database\DbActive{

    CONST TABLE_NAME = 'pms_projects';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'logframe_instance_id' => ['type'=>'int', 'label' => 'Logframe Instance Id', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => FALSE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => TRUE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * varchar(350)
     * @var string 
     */
    public $name;

    /**
     * Logframe Instance Id
     * (Required)
     * int(11) unsigned
     * @var int 
     */
    public $logframe_instance_id;

    /**
     * Description
     * varchar(650)
     * @var string 
     */
    public $description;

    /**
     * Start Date
     * date
     * @var string 
     */
    public $start_date;

    /**
     * End Date
     * date
     * @var string 
     */
    public $end_date;

    /**
     * Created
     * (Required)
     * timestamp
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

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsactivityplans[]
     */
    function getPmsactivityplans($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsactivityplans[] $_e */
        $_e = $this->PDOBuild->table('pms_activity_plans', 't_tbl')->getAll('\Database\Monitoreorg\Pmsactivityplans');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsworkplan[]
     */
    function getPmsworkplan($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_activity_plans tbl0', 'tbl0.id = t_tbl.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplan[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplan');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsimplementations[]
     */
    function getPmsimplementations($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsimplementations[] $_e */
        $_e = $this->PDOBuild->table('pms_implementations', 't_tbl')->getAll('\Database\Monitoreorg\Pmsimplementations');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsimplementationaccounts[]
     */
    function getPmsimplementationaccounts($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_implementations tbl2', 'tbl2.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl1', 'tbl1.id = tbl2.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsimplementationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_implementation_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsimplementationaccounts');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsworkplanbudget[]
     */
    function getPmsworkplanbudget($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplanbudget[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan_budget', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplanbudget');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsactivityplans(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_activity_plans','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplan(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_activity_plans tbl0', 'tbl0.id = t_tbl.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementations','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_implementations tbl2', 'tbl2.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl1', 'tbl1.id = tbl2.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsprogramproject[]
     */
    function getPmsprogramproject($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.project_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsprogramproject[] $_e */
        $_e = $this->PDOBuild->table('pms_program_project', 't_tbl')->getAll('\Database\Monitoreorg\Pmsprogramproject');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsprogramproject(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.project_id', (int)$this->id);
        return $this->PDOBuild->table('pms_program_project','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsprojects
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

