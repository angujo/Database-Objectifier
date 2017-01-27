<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setSurveyId(int  $survey_id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setListOrder(int  $list_order);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdtated(string  $updtated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getSurveyId();
 * @method string  getName();
 * @method string  getDescription();
 * @method int  getListOrder();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdtated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Svysections extends Database\DbActive{

    CONST TABLE_NAME = 'svy_sections';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'survey_id' => ['type'=>'int', 'label' => 'Survey Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'list_order' => ['type'=>'int', 'label' => 'List Order', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updtated' => ['type'=>'string', 'label' => 'Updtated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Survey Id
     * (Required)
     * int(11) unsigned
     * @var int 
     */
    public $survey_id;

    /**
     * Name
     * (Required)
     * varchar(75)
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
     * List Order
     * int(11)
     * @var int 
     */
    public $list_order;

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
     * Updtated
     * datetime
     * @var string 
     */
    public $updtated;

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
     * @return Svyquestions[]
     */
    function getSvyquestions($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.section_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyquestions[] $_e */
        $_e = $this->PDOBuild->table('svy_questions', 't_tbl')->getAll('\Database\Monitoreorg\Svyquestions');
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
        $this->PDOBuild->joinInner('svy_questions tbl0', 'tbl0.id = t_tbl.question_id')
            ->where('tbl0.section_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyanswers[] $_e */
        $_e = $this->PDOBuild->table('svy_answers', 't_tbl')->getAll('\Database\Monitoreorg\Svyanswers');
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
        $this->PDOBuild->joinInner('svy_questions tbl0', 'tbl0.id = t_tbl.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_assessments tbl2', 'tbl2.id = t_tbl.assessment_id')
            ->joinInner('svy_questions tbl0', 'tbl0.id = tbl2.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_assessments tbl2', 'tbl2.id = t_tbl.assessment_id')
            ->joinInner('svy_questions tbl0', 'tbl0.id = tbl2.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyinstances[] $_e */
        $_e = $this->PDOBuild->table('svy_instances', 't_tbl')->getAll('\Database\Monitoreorg\Svyinstances');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyquestions(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.section_id', (int)$this->id);
        return $this->PDOBuild->table('svy_questions','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_questions tbl0', 'tbl0.id = t_tbl.question_id')
            ->where('tbl0.section_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyassessments(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_questions tbl0', 'tbl0.id = t_tbl.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
        return $this->PDOBuild->table('svy_assessments','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvydataschedules(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl2', 'tbl2.id = t_tbl.assessment_id')
            ->joinInner('svy_questions tbl0', 'tbl0.id = tbl2.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
        return $this->PDOBuild->table('svy_data_schedules','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyinstances(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl2', 'tbl2.id = t_tbl.assessment_id')
            ->joinInner('svy_questions tbl0', 'tbl0.id = tbl2.realtime_column')
            ->where('tbl0.section_id', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svysections
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

