<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setSlug(string  $slug);
 * @method $this setSubjectGroupId(int  $subject_group_id);
 * @method $this setAssessmentId(int  $assessment_id);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setClosed(int  $closed);
 * @method int  getId();
 * @method string  getSlug();
 * @method int  getSubjectGroupId();
 * @method int  getAssessmentId();
 * @method int  getStructureId();
 * @method int  getSupervisorId();
 * @method int  getClosed();
 */
class Svyinstances extends Database\DbActive{

    CONST TABLE_NAME = 'svy_instances';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'slug' => ['type'=>'string', 'label' => 'Slug', 'unique' => TRUE, 'required' => TRUE], 'subject_group_id' => ['type'=>'int', 'label' => 'Subject Group Id', 'unique' => FALSE, 'required' => FALSE], 'assessment_id' => ['type'=>'int', 'label' => 'Assessment Id', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => FALSE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => FALSE], 'closed' => ['type'=>'int', 'label' => 'Closed', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Slug
     * (Required)
     * varchar(120)
     * @var string 
     */
    public $slug;

    /**
     * Subject Group Id
     * int(11) unsigned
     * @var int 
     */
    public $subject_group_id;

    /**
     * Assessment Id
     * int(11) unsigned
     * @var int 
     */
    public $assessment_id;

    /**
     * Structure Id
     * int(11) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Supervisor Id
     * int(11) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Closed
     * tinyint(1)
     * @var int 
     */
    public $closed;

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
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.instance_id', (int)$this->id);
        return $this->PDOBuild->table('svy_answers','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svyinstances
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

