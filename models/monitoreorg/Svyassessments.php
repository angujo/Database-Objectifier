<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setSurveyId(int  $survey_id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setRealtimeColumn(int  $realtime_column);
 * @method $this setSmsConnection(int  $sms_connection);
 * @method $this setSubjectGroup(int  $subject_group);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method int  getId();
 * @method int  getSurveyId();
 * @method string  getName();
 * @method string  getDescription();
 * @method int  getRealtimeColumn();
 * @method int  getSmsConnection();
 * @method int  getSubjectGroup();
 * @method string  getStartDate();
 * @method string  getEndDate();
 */
class Svyassessments extends Database\DbActive{

    CONST TABLE_NAME = 'svy_assessments';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'survey_id' => ['type'=>'int', 'label' => 'Survey Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'realtime_column' => ['type'=>'int', 'label' => 'Realtime Column', 'unique' => FALSE, 'required' => FALSE], 'sms_connection' => ['type'=>'int', 'label' => 'Sms Connection', 'unique' => FALSE, 'required' => FALSE], 'subject_group' => ['type'=>'int', 'label' => 'Subject Group', 'unique' => FALSE, 'required' => FALSE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => FALSE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Survey Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $survey_id;

    /**
     * Name
     * (Required)
     * varchar(150)
     * @var string 
     */
    public $name;

    /**
     * Description
     * varchar(450)
     * @var string 
     */
    public $description;

    /**
     * Realtime Column
     * int(10) unsigned
     * @var int 
     */
    public $realtime_column;

    /**
     * Sms Connection
     * int(11) unsigned
     * @var int 
     */
    public $sms_connection;

    /**
     * Subject Group
     * int(10) unsigned
     * @var int 
     */
    public $subject_group;

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

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Svydataschedules[]
     */
    function getSvydataschedules($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.assessment_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.assessment_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.assessment_id', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_instances tbl1', 'tbl1.id = t_tbl.instance_id')
            ->where('tbl1.assessment_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.assessment_id', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_instances tbl1', 'tbl1.id = t_tbl.instance_id')
            ->where('tbl1.assessment_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svyassessments
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

