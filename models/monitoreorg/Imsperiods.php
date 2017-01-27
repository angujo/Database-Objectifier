<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setParentId(int  $parent_id);
 * @method $this setName(string  $name);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setActive(string  $active);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getParentId();
 * @method string  getName();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method string  getActive();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Imsperiods extends Database\DbActive{

    CONST TABLE_NAME = 'ims_periods';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'parent_id' => ['type'=>'int', 'label' => 'Parent Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => TRUE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => TRUE], 'active' => ['type'=>'string', 'label' => 'Active', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Parent Id
     * int(10) unsigned
     * @var int 
     */
    public $parent_id;

    /**
     * Name
     * (Required)
     * varchar(450)
     * @var string 
     */
    public $name;

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
     * Active
     * varchar(2)
     * @var string 
     */
    public $active;

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
     * @return Imsexchanges[]
     */
    function getImsexchanges($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Imsexchanges[] $_e */
        $_e = $this->PDOBuild->table('ims_exchanges', 't_tbl')->getAll('\Database\Monitoreorg\Imsexchanges');
        return $_e;
    }

    /**
     * @return int
     */
    function countImsexchanges(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
        return $this->PDOBuild->table('ims_exchanges','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsactivityplans[]
     */
    function getPmsactivityplans($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
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
            ->where('tbl1.period_id', (int)$this->id);
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
            ->where('tbl1.period_id', (int)$this->id);
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
            ->where('tbl1.period_id', (int)$this->id);
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
            ->where('tbl1.period_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_activity_plans','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplan(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_activity_plans tbl1', 'tbl1.id = t_tbl.activity_plan_id')
            ->where('tbl1.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->where('tbl1.period_id', (int)$this->id);
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
            ->where('tbl1.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl2', 'tbl2.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl1', 'tbl1.id = tbl2.activity_plan_id')
            ->where('tbl1.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadminbudgets[]
     */
    function getPmsadminbudgets($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.semi_period_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadminbudgets[] $_e */
        $_e = $this->PDOBuild->table('pms_admin_budgets', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadminbudgets');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsadminbudgets(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.semi_period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_admin_budgets','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadministration[]
     */
    function getPmsadministration($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadministration[] $_e */
        $_e = $this->PDOBuild->table('pms_administration', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadministration');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadministrationaccounts[]
     */
    function getPmsadministrationaccounts($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_administration tbl7', 'tbl7.id = t_tbl.administration_id')
            ->where('tbl7.period_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadministrationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_administration_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadministrationaccounts');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsadministration(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_administration','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsadministrationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_administration tbl7', 'tbl7.id = t_tbl.administration_id')
            ->where('tbl7.period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_administration_accounts','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsdisaggregatevalues[]
     */
    function getPmsdisaggregatevalues($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.semi_period_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsdisaggregatevalues[] $_e */
        $_e = $this->PDOBuild->table('pms_disaggregate_values', 't_tbl')->getAll('\Database\Monitoreorg\Pmsdisaggregatevalues');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsdisaggregatevalues(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.semi_period_id', (int)$this->id);
        return $this->PDOBuild->table('pms_disaggregate_values','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Imsperiods
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:06 UTC
 */

