<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setAccess(string  $access);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getName();
 * @method string  getDescription();
 * @method int  getSupervisorId();
 * @method int  getStructureId();
 * @method string  getAccess();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Svysubjectgroups extends Database\DbActive{

    CONST TABLE_NAME = 'svy_subject_groups';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => TRUE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'access' => ['type'=>'string', 'label' => 'Access', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * (Required)
     * varchar(65)
     * @var string 
     */
    public $name;

    /**
     * Description
     * varchar(750)
     * @var string 
     */
    public $description;

    /**
     * Supervisor Id
     * (Required)
     * int(11) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Structure Id
     * (Required)
     * int(11) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Access
     * varchar(45)
     * @var string 
     */
    public $access;

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
     * @return Svyassessments[]
     */
    function getSvyassessments($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.subject_group', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyassessments[] $_e */
        $_e = $this->PDOBuild->table('svy_assessments', 't_tbl')->getAll('\Database\Monitoreorg\Svyassessments');
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
        $this->PDOBuild->joinInner('svy_assessments tbl0', 'tbl0.id = t_tbl.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_assessments tbl0', 'tbl0.id = t_tbl.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_instances tbl2', 'tbl2.id = t_tbl.instance_id')
            ->joinInner('svy_assessments tbl0', 'tbl0.id = tbl2.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyanswers[] $_e */
        $_e = $this->PDOBuild->table('svy_answers', 't_tbl')->getAll('\Database\Monitoreorg\Svyanswers');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyassessments(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.subject_group', (int)$this->id);
        return $this->PDOBuild->table('svy_assessments','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvydataschedules(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl0', 'tbl0.id = t_tbl.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
        return $this->PDOBuild->table('svy_data_schedules','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyinstances(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl0', 'tbl0.id = t_tbl.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_instances tbl2', 'tbl2.id = t_tbl.instance_id')
            ->joinInner('svy_assessments tbl0', 'tbl0.id = tbl2.assessment_id')
            ->where('tbl0.subject_group', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyquestions[]
     */
    function getSvyquestions($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.subject_group_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyquestions[] $_e */
        $_e = $this->PDOBuild->table('svy_questions', 't_tbl')->getAll('\Database\Monitoreorg\Svyquestions');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyquestions(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.subject_group_id', (int)$this->id);
        return $this->PDOBuild->table('svy_questions','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svysubjectgroups
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

