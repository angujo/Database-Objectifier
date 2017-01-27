<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setPlanSupervisorId(int  $plan_supervisor_id);
 * @method $this setActivitySupervisorId(int  $activity_supervisor_id);
 * @method $this setRights(string  $rights);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getStructureId();
 * @method string  getName();
 * @method string  getDescription();
 * @method int  getSupervisorId();
 * @method int  getPlanSupervisorId();
 * @method int  getActivitySupervisorId();
 * @method string  getRights();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Imsoffices extends Database\DbActive{

    CONST TABLE_NAME = 'ims_offices';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => TRUE], 'plan_supervisor_id' => ['type'=>'int', 'label' => 'Plan Supervisor Id', 'unique' => FALSE, 'required' => FALSE], 'activity_supervisor_id' => ['type'=>'int', 'label' => 'Activity Supervisor Id', 'unique' => FALSE, 'required' => FALSE], 'rights' => ['type'=>'string', 'label' => 'Rights', 'unique' => FALSE, 'required' => TRUE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Structure Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $structure_id;

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
     * Supervisor Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Plan Supervisor Id
     * int(11)
     * @var int 
     */
    public $plan_supervisor_id;

    /**
     * Activity Supervisor Id
     * int(11)
     * @var int 
     */
    public $activity_supervisor_id;

    /**
     * Rights
     * (Required)
     * varchar(1100)
     * @var string 
     */
    public $rights;

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
     * @return Pmsactivityplans[]
     */
    function getPmsactivityplans($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.supervisor', (int)$this->id);
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
            ->where('tbl0.supervisor', (int)$this->id);
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
            ->where('tbl0.supervisor', (int)$this->id);
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
            ->where('tbl0.supervisor', (int)$this->id);
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
            ->where('tbl0.supervisor', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.supervisor', (int)$this->id);
        return $this->PDOBuild->table('pms_activity_plans','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplan(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_activity_plans tbl0', 'tbl0.id = t_tbl.activity_plan_id')
            ->where('tbl0.supervisor', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.supervisor', (int)$this->id);
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
            ->where('tbl0.supervisor', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl1', 'tbl1.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl0', 'tbl0.id = tbl1.activity_plan_id')
            ->where('tbl0.supervisor', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svydataschedules[]
     */
    function getSvydataschedules($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svydataschedules[] $_e */
        $_e = $this->PDOBuild->table('svy_data_schedules', 't_tbl')->getAll('\Database\Monitoreorg\Svydataschedules');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvydataschedules(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_data_schedules','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyinstances[]
     */
    function getSvyinstances($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyinstances[] $_e */
        $_e = $this->PDOBuild->table('svy_instances', 't_tbl')->getAll('\Database\Monitoreorg\Svyinstances');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyanswers[]
     */
    function getSvyanswers($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('svy_instances tbl6', 'tbl6.id = t_tbl.instance_id')
            ->where('tbl6.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyanswers[] $_e */
        $_e = $this->PDOBuild->table('svy_answers', 't_tbl')->getAll('\Database\Monitoreorg\Svyanswers');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyinstances(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_instances tbl6', 'tbl6.id = t_tbl.instance_id')
            ->where('tbl6.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svysubjectgroups[]
     */
    function getSvysubjectgroups($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svysubjectgroups[] $_e */
        $_e = $this->PDOBuild->table('svy_subject_groups', 't_tbl')->getAll('\Database\Monitoreorg\Svysubjectgroups');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyassessments[]
     */
    function getSvyassessments($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('svy_subject_groups tbl8', 'tbl8.id = t_tbl.subject_group')
            ->where('tbl8.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyassessments[] $_e */
        $_e = $this->PDOBuild->table('svy_assessments', 't_tbl')->getAll('\Database\Monitoreorg\Svyassessments');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyquestions[]
     */
    function getSvyquestions($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('svy_subject_groups tbl8', 'tbl8.id = t_tbl.subject_group_id')
            ->where('tbl8.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyquestions[] $_e */
        $_e = $this->PDOBuild->table('svy_questions', 't_tbl')->getAll('\Database\Monitoreorg\Svyquestions');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvysubjectgroups(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_subject_groups','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyassessments(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_subject_groups tbl8', 'tbl8.id = t_tbl.subject_group')
            ->where('tbl8.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_assessments','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyquestions(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_subject_groups tbl8', 'tbl8.id = t_tbl.subject_group_id')
            ->where('tbl8.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_questions','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svysurvey[]
     */
    function getSvysurvey($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svysurvey[] $_e */
        $_e = $this->PDOBuild->table('svy_survey', 't_tbl')->getAll('\Database\Monitoreorg\Svysurvey');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svysections[]
     */
    function getSvysections($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('svy_survey tbl11', 'tbl11.id = t_tbl.survey_id')
            ->where('tbl11.supervisor_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svysections[] $_e */
        $_e = $this->PDOBuild->table('svy_sections', 't_tbl')->getAll('\Database\Monitoreorg\Svysections');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvysurvey(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_survey','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvysections(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_survey tbl11', 'tbl11.id = t_tbl.survey_id')
            ->where('tbl11.supervisor_id', (int)$this->id);
        return $this->PDOBuild->table('svy_sections','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Imsoffices
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:06 UTC
 */

