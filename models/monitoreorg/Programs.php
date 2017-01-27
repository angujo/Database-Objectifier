<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setShortName(string  $short_name);
 * @method $this setDescription(string  $description);
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
 * @method string  getName();
 * @method string  getShortName();
 * @method string  getDescription();
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
class Programs extends Database\DbActive{

    CONST TABLE_NAME = 'programs';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => TRUE, 'required' => TRUE], 'short_name' => ['type'=>'string', 'label' => 'Short Name', 'unique' => TRUE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => FALSE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => FALSE], 'active' => ['type'=>'string', 'label' => 'Active', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => TRUE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * (Required)
     * varchar(250)
     * @var string 
     */
    public $name;

    /**
     * Short Name
     * varchar(100)
     * @var string 
     */
    public $short_name;

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
     * Active
     * varchar(3)
     * @var string 
     */
    public $active;

    /**
     * Created
     * (Required)
     * timestamp
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

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Programs
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

