<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setSubjectGroupId(int  $subject_group_id);
 * @method $this setSectionId(int  $section_id);
 * @method $this setQuestion(string  $question);
 * @method $this setQtype(string  $qtype);
 * @method $this setColumnarName(string  $columnar_name);
 * @method $this setInstruction(string  $instruction);
 * @method $this setCompulsory(string  $compulsory);
 * @method $this setMinValue(string  $min_value);
 * @method $this setMaxValue(string  $max_value);
 * @method $this setYOptions(string  $y_options);
 * @method $this setXOptions(string  $x_options);
 * @method $this setSeparator(string  $separator);
 * @method $this setDecPlaces(int  $dec_places);
 * @method $this setTableType(string  $table_type);
 * @method $this setListOrder(int  $list_order);
 * @method $this setIdentifier(int  $identifier);
 * @method int  getId();
 * @method int  getSubjectGroupId();
 * @method int  getSectionId();
 * @method string  getQuestion();
 * @method string  getQtype();
 * @method string  getColumnarName();
 * @method string  getInstruction();
 * @method string  getCompulsory();
 * @method string  getMinValue();
 * @method string  getMaxValue();
 * @method string  getYOptions();
 * @method string  getXOptions();
 * @method string  getSeparator();
 * @method int  getDecPlaces();
 * @method string  getTableType();
 * @method int  getListOrder();
 * @method int  getIdentifier();
 */
class Svyquestions extends Database\DbActive{

    CONST TABLE_NAME = 'svy_questions';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'subject_group_id' => ['type'=>'int', 'label' => 'Subject Group Id', 'unique' => FALSE, 'required' => FALSE], 'section_id' => ['type'=>'int', 'label' => 'Section Id', 'unique' => FALSE, 'required' => FALSE], 'question' => ['type'=>'string', 'label' => 'Question', 'unique' => FALSE, 'required' => TRUE], 'qtype' => ['type'=>'string', 'label' => 'Qtype', 'unique' => FALSE, 'required' => TRUE], 'columnar_name' => ['type'=>'string', 'label' => 'Columnar Name', 'unique' => FALSE, 'required' => TRUE], 'instruction' => ['type'=>'string', 'label' => 'Instruction', 'unique' => FALSE, 'required' => FALSE], 'compulsory' => ['type'=>'string', 'label' => 'Compulsory', 'unique' => FALSE, 'required' => FALSE], 'min_value' => ['type'=>'string', 'label' => 'Min Value', 'unique' => FALSE, 'required' => FALSE], 'max_value' => ['type'=>'string', 'label' => 'Max Value', 'unique' => FALSE, 'required' => FALSE], 'y_options' => ['type'=>'string', 'label' => 'Y Options', 'unique' => FALSE, 'required' => FALSE], 'x_options' => ['type'=>'string', 'label' => 'X Options', 'unique' => FALSE, 'required' => FALSE], 'separator' => ['type'=>'string', 'label' => 'Separator', 'unique' => FALSE, 'required' => FALSE], 'dec_places' => ['type'=>'int', 'label' => 'Dec Places', 'unique' => FALSE, 'required' => FALSE], 'table_type' => ['type'=>'string', 'label' => 'Table Type', 'unique' => FALSE, 'required' => FALSE], 'list_order' => ['type'=>'int', 'label' => 'List Order', 'unique' => FALSE, 'required' => FALSE], 'identifier' => ['type'=>'int', 'label' => 'Identifier', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Subject Group Id
     * int(10) unsigned
     * @var int 
     */
    public $subject_group_id;

    /**
     * Section Id
     * int(10) unsigned
     * @var int 
     */
    public $section_id;

    /**
     * Question
     * (Required)
     * varchar(450)
     * @var string 
     */
    public $question;

    /**
     * Qtype
     * (Required)
     * varchar(20)
     * @var string 
     */
    public $qtype;

    /**
     * Columnar Name
     * (Required)
     * varchar(65)
     * @var string 
     */
    public $columnar_name;

    /**
     * Instruction
     * varchar(650)
     * @var string 
     */
    public $instruction;

    /**
     * Compulsory
     * varchar(2)
     * @var string 
     */
    public $compulsory;

    /**
     * Min Value
     * varchar(150)
     * @var string 
     */
    public $min_value;

    /**
     * Max Value
     * varchar(150)
     * @var string 
     */
    public $max_value;

    /**
     * Y Options
     * varchar(850)
     * @var string 
     */
    public $y_options;

    /**
     * X Options
     * varchar(850)
     * @var string 
     */
    public $x_options;

    /**
     * Separator
     * varchar(3)
     * @var string 
     */
    public $separator;

    /**
     * Dec Places
     * int(11)
     * @var int 
     */
    public $dec_places;

    /**
     * Table Type
     * varchar(20)
     * @var string 
     */
    public $table_type;

    /**
     * List Order
     * int(11)
     * @var int 
     */
    public $list_order;

    /**
     * Identifier
     * tinyint(1)
     * @var int 
     */
    public $identifier;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyanswers[]
     */
    function getSvyanswers($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.question_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyanswers[] $_e */
        $_e = $this->PDOBuild->table('svy_answers', 't_tbl')->getAll('\Database\Monitoreorg\Svyanswers');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyanswers(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.question_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Svyassessments[]
     */
    function getSvyassessments($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.realtime_column', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_assessments tbl1', 'tbl1.id = t_tbl.assessment_id')
            ->where('tbl1.realtime_column', (int)$this->id);
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
        $this->PDOBuild->joinInner('svy_assessments tbl1', 'tbl1.id = t_tbl.assessment_id')
            ->where('tbl1.realtime_column', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Svyinstances[] $_e */
        $_e = $this->PDOBuild->table('svy_instances', 't_tbl')->getAll('\Database\Monitoreorg\Svyinstances');
        return $_e;
    }

    /**
     * @return int
     */
    function countSvyassessments(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.realtime_column', (int)$this->id);
        return $this->PDOBuild->table('svy_assessments','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvydataschedules(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl1', 'tbl1.id = t_tbl.assessment_id')
            ->where('tbl1.realtime_column', (int)$this->id);
        return $this->PDOBuild->table('svy_data_schedules','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countSvyinstances(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('svy_assessments tbl1', 'tbl1.id = t_tbl.assessment_id')
            ->where('tbl1.realtime_column', (int)$this->id);
        return $this->PDOBuild->table('svy_instances','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svyquestions
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

