<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setOrderNumber(int  $order_number);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getName();
 * @method int  getOrderNumber();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Imsstructurelevels extends Database\DbActive{

    CONST TABLE_NAME = 'ims_structure_levels';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'order_number' => ['type'=>'int', 'label' => 'Order Number', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

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
     * Order Number
     * int(11)
     * @var int 
     */
    public $order_number;

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
     * @return Imsstructures[]
     */
    function getImsstructures($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Imsstructures[] $_e */
        $_e = $this->PDOBuild->table('ims_structures', 't_tbl')->getAll('\Database\Monitoreorg\Imsstructures');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Imsoffices[]
     */
    function getImsoffices($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Imsoffices[] $_e */
        $_e = $this->PDOBuild->table('ims_offices', 't_tbl')->getAll('\Database\Monitoreorg\Imsoffices');
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
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_activity_plans tbl2', 'tbl2.id = t_tbl.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_workplan tbl3', 'tbl3.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_implementations tbl4', 'tbl4.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl3', 'tbl3.id = tbl4.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('pms_workplan tbl3', 'tbl3.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplanbudget[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan_budget', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplanbudget');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svydataschedules[]
     */
    function getSvydataschedules($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svydataschedules[] $_e */
        $_e = $this->PDOBuild->table('svy_data_schedules', 't_tbl')->getAll('\Database\Monitoreorg\Svydataschedules');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyinstances[]
     */
    function getSvyinstances($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_instances tbl8', 'tbl8.id = t_tbl.instance_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl8.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyanswers[] $_e */
        $_e = $this->PDOBuild->table('svy_answers', 't_tbl')->getAll('\Database\Monitoreorg\Svyanswers');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svysubjectgroups[]
     */
    function getSvysubjectgroups($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_subject_groups tbl10', 'tbl10.id = t_tbl.subject_group')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl10.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_subject_groups tbl10', 'tbl10.id = t_tbl.subject_group_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl10.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyquestions[] $_e */
        $_e = $this->PDOBuild->table('svy_questions', 't_tbl')->getAll('\Database\Monitoreorg\Svyquestions');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svysurvey[]
     */
    function getSvysurvey($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_survey tbl13', 'tbl13.id = t_tbl.survey_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl13.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svysections[] $_e */
        $_e = $this->PDOBuild->table('svy_sections', 't_tbl')->getAll('\Database\Monitoreorg\Svysections');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadminbudgets[]
     */
    function getPmsadminbudgets($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadminbudgets[] $_e */
        $_e = $this->PDOBuild->table('pms_admin_budgets', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadminbudgets');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmslogframe[]
     */
    function getPmslogframe($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmslogframe[] $_e */
        $_e = $this->PDOBuild->table('pms_logframe', 't_tbl')->getAll('\Database\Monitoreorg\Pmslogframe');
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
        $this->PDOBuild->joinInner('pms_logframe tbl16', 'tbl16.id = t_tbl.logframe_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl16.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmslogframemeta[] $_e */
        $_e = $this->PDOBuild->table('pms_logframe_meta', 't_tbl')->getAll('\Database\Monitoreorg\Pmslogframemeta');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreports[]
     */
    function getPmsreports($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreports[] $_e */
        $_e = $this->PDOBuild->table('pms_reports', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreports');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportfilters[]
     */
    function getPmsreportfilters($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportfilters[] $_e */
        $_e = $this->PDOBuild->table('pms_report_filters', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportfilters');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsections[]
     */
    function getPmsreportsections($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsections[] $_e */
        $_e = $this->PDOBuild->table('pms_report_sections', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsections');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsectioncolumns[]
     */
    function getPmsreportsectioncolumns($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_report_sections tbl20', 'tbl20.id = t_tbl.section_id')
            ->joinInner('pms_reports tbl18', 'tbl18.id = tbl20.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsectioncolumns[] $_e */
        $_e = $this->PDOBuild->table('pms_report_section_columns', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsectioncolumns');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsignatories[]
     */
    function getPmsreportsignatories($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsignatories[] $_e */
        $_e = $this->PDOBuild->table('pms_report_signatories', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsignatories');
        return $_e;
    }

    /**
     * @return int
     */
    function countImsstructures(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.level_id', (int)$this->id);
        return $this->PDOBuild->table('ims_structures','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countImsoffices(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('ims_offices','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsactivityplans(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_activity_plans','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplan(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_activity_plans tbl2', 'tbl2.id = t_tbl.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementations(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl3', 'tbl3.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementations','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_implementations tbl4', 'tbl4.id = t_tbl.implementation_id')
            ->joinInner('pms_workplan tbl3', 'tbl3.id = tbl4.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_workplan tbl3', 'tbl3.id = t_tbl.work_plan_id')
            ->joinInner('pms_activity_plans tbl2', 'tbl2.id = tbl3.activity_plan_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl2.supervisor')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvydataschedules(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_data_schedules','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyinstances(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_instances tbl8', 'tbl8.id = t_tbl.instance_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl8.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvysubjectgroups(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_subject_groups','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyassessments(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_subject_groups tbl10', 'tbl10.id = t_tbl.subject_group')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl10.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_assessments','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyquestions(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_subject_groups tbl10', 'tbl10.id = t_tbl.subject_group_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl10.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_questions','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvysurvey(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_offices tbl1', 'tbl1.id = t_tbl.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_survey','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvysections(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_survey tbl13', 'tbl13.id = t_tbl.survey_id')
            ->joinInner('ims_offices tbl1', 'tbl1.id = tbl13.supervisor_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl1.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('svy_sections','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsadminbudgets(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_admin_budgets','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmslogframe(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_logframe','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmslogframemeta(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_logframe tbl16', 'tbl16.id = t_tbl.logframe_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl16.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_logframe_meta','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreports(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('ims_structures tbl0', 'tbl0.id = t_tbl.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_reports','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreportfilters(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_filters','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreportsections(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_sections','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreportsectioncolumns(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_report_sections tbl20', 'tbl20.id = t_tbl.section_id')
            ->joinInner('pms_reports tbl18', 'tbl18.id = tbl20.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_section_columns','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreportsignatories(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_reports tbl18', 'tbl18.id = t_tbl.report_id')
            ->joinInner('ims_structures tbl0', 'tbl0.id = tbl18.structure_id')
            ->where('tbl0.level_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_signatories','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Imsstructurelevels
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:07 UTC
 */

