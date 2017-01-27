<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setType(string  $type);
 * @method $this setReferenceId(int  $reference_id);
 * @method $this setName(string  $name);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getType();
 * @method int  getReferenceId();
 * @method string  getName();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsdisaggregates extends Database\DbActive{

    CONST TABLE_NAME = 'pms_disaggregates';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => FALSE], 'reference_id' => ['type'=>'int', 'label' => 'Reference Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Type
     * varchar(45)
     * @var string 
     */
    public $type;

    /**
     * Reference Id
     * int(10) unsigned
     * @var int 
     */
    public $reference_id;

    /**
     * Name
     * text
     * @var string 
     */
    public $name;

    /**
     * Created
     * datetime
     * @var string 
     */
    public $created;

    /**
     * Created By
     * int(11)
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
     * int(11)
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
     * int(11)
     * @var int 
     */
    public $deleted_by;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsdisaggregatevalues[]
     */
    function getPmsdisaggregatevalues($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.disaggregate_id', (int)$this->id);
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
        $this->PDOBuild->where('t_tbl.disaggregate_id', (int)$this->id);
        return $this->PDOBuild->table('pms_disaggregate_values','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsdisaggregates
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:08 UTC
 */

