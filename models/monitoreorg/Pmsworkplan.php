<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setActivityPlanId(int  $activity_plan_id);
 * @method $this setIndicatorId(int  $indicator_id);
 * @method $this setSupervisor(int  $supervisor);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setAccessibility(string  $accessibility);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getActivityPlanId();
 * @method int  getIndicatorId();
 * @method int  getSupervisor();
 * @method string  getName();
 * @method string  getDescription();
 * @method string  getAccessibility();
 * @method int  getStructureId();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsworkplan extends Database\DbActive{

    CONST TABLE_NAME = 'pms_workplan';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'activity_plan_id' => ['type'=>'int', 'label' => 'Activity Plan Id', 'unique' => FALSE, 'required' => TRUE], 'indicator_id' => ['type'=>'int', 'label' => 'Indicator Id', 'unique' => FALSE, 'required' => TRUE], 'supervisor' => ['type'=>'int', 'label' => 'Supervisor', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'accessibility' => ['type'=>'string', 'label' => 'Accessibility', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Activity Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $activity_plan_id;

    /**
     * Indicator Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $indicator_id;

    /**
     * Supervisor
     * int(10) unsigned
     * @var int 
     */
    public $supervisor;

    /**
     * Name
     * varchar(450)
     * @var string 
     */
    public $name;

    /**
     * Description
     * varchar(650)
     * @var string 
     */
    public $description;

    /**
     * Accessibility
     * varchar(20)
     * @var string 
     */
    public $accessibility;

    /**
     * Structure Id
     * int(11) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Created
     * datetime
     * @var string 
     */
    public $created;

    /**
     * Created By
     * int(10) unsigned
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
     * int(10) unsigned
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
     * int(10) unsigned
     * @var int 
     */
    public $deleted_by;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsimplementations[]
     */
    function getPmsimplementations($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.work_plan_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_implementations tbl0', 'tbl0.id = t_tbl.implementation_id')
            ->where('tbl0.work_plan_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsimplementationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_implementation_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsimplementationaccounts');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.work_plan_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementations','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_implementations tbl0', 'tbl0.id = t_tbl.implementation_id')
            ->where('tbl0.work_plan_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsworkplanbudget[]
     */
    function getPmsworkplanbudget($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.work_plan_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplanbudget[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan_budget', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplanbudget');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.work_plan_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsworkplan
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

