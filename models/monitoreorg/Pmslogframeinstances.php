<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getName();
 * @method string  getDescription();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmslogframeinstances extends Database\DbActive{

    CONST TABLE_NAME = 'pms_logframe_instances';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * (Required)
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
     * @return Pmslogframe[]
     */
    function getPmslogframe($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmslogframe[] $_e */
        $_e = $this->PDOBuild->table('pms_logframe', 't_tbl')->getAll('\Database\Monitoreorg\Pmslogframe');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsactivityplans[]
     */
    function getPmsactivityplans($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_logframe tbl0', 'tbl0.id = t_tbl.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_activity_plans tbl1', 'tbl1.id = t_tbl.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_implementations tbl3', 'tbl3.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl2', 'tbl2.id = tbl3.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplanbudget[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan_budget', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplanbudget');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmslogframemeta[]
     */
    function getPmslogframemeta($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_logframe tbl0', 'tbl0.id = t_tbl.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmslogframemeta[] $_e */
        $_e = $this->PDOBuild->table('pms_logframe_meta', 't_tbl')->getAll('\Database\Monitoreorg\Pmslogframemeta');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmslogframe(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_logframe','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsactivityplans(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_logframe tbl0', 'tbl0.id = t_tbl.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_activity_plans','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplan(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_activity_plans tbl1', 'tbl1.id = t_tbl.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementations','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_implementations tbl3', 'tbl3.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl2', 'tbl2.id = tbl3.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->joinInner('pms_logframe tbl0', 'tbl0.id = tbl1.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmslogframemeta(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_logframe tbl0', 'tbl0.id = t_tbl.logframe_id')
            ->where('tbl0.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_logframe_meta','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmslogframestructures[]
     */
    function getPmslogframestructures($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmslogframestructures[] $_e */
        $_e = $this->PDOBuild->table('pms_logframe_structures', 't_tbl')->getAll('\Database\Monitoreorg\Pmslogframestructures');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmslogframestructures(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_logframe_structures','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsprojects[]
     */
    function getPmsprojects($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.logframe_instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsprojects[] $_e */
        $_e = $this->PDOBuild->table('pms_projects', 't_tbl')->getAll('\Database\Monitoreorg\Pmsprojects');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsprogramproject[]
     */
    function getPmsprogramproject($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_projects tbl8', 'tbl8.id = t_tbl.project_id')
            ->where('tbl8.logframe_instance_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsprogramproject[] $_e */
        $_e = $this->PDOBuild->table('pms_program_project', 't_tbl')->getAll('\Database\Monitoreorg\Pmsprogramproject');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsprojects(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.logframe_instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_projects','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsprogramproject(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_projects tbl8', 'tbl8.id = t_tbl.project_id')
            ->where('tbl8.logframe_instance_id', (int)$this->id);
        return $this->PDOBuild->table('pms_program_project','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmslogframeinstances
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:09 UTC
 */

