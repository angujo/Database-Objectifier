<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setType(string  $type);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getType();
 * @method string  getName();
 * @method string  getDescription();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsprogproj extends Database\DbActive{

    CONST TABLE_NAME = 'pms_progproj';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => FALSE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => TRUE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Type
     * (Required)
     * varchar(45)
     * @var string 
     */
    public $type;

    /**
     * Name
     * (Required)
     * varchar(250)
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
     * Start Date
     * datetime
     * @var string 
     */
    public $start_date;

    /**
     * End Date
     * datetime
     * @var string 
     */
    public $end_date;

    /**
     * Created
     * (Required)
     * timestamp
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
     * @return Pmsprogramproject[]
     */
    function getPmsprogramproject($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.program_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsprogramproject[] $_e */
        $_e = $this->PDOBuild->table('pms_program_project', 't_tbl')->getAll('\Database\Monitoreorg\Pmsprogramproject');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsprogramproject(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.program_id', (int)$this->id);
        return $this->PDOBuild->table('pms_program_project','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsprogproj
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:09 UTC
 */

