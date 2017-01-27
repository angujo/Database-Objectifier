<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setDisaggregateId(int  $disaggregate_id);
 * @method $this setType(string  $type);
 * @method $this setReferenceId(int  $reference_id);
 * @method $this setSemiPeriodId(int  $semi_period_id);
 * @method $this setTarget(float  $target);
 * @method $this setAchieved(float  $achieved);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getDisaggregateId();
 * @method string  getType();
 * @method int  getReferenceId();
 * @method int  getSemiPeriodId();
 * @method float  getTarget();
 * @method float  getAchieved();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsdisaggregatevalues extends Database\DbActive{

    CONST TABLE_NAME = 'pms_disaggregate_values';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'disaggregate_id' => ['type'=>'int', 'label' => 'Disaggregate Id', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => FALSE], 'reference_id' => ['type'=>'int', 'label' => 'Reference Id', 'unique' => FALSE, 'required' => FALSE], 'semi_period_id' => ['type'=>'int', 'label' => 'Semi Period Id', 'unique' => FALSE, 'required' => FALSE], 'target' => ['type'=>'float', 'label' => 'Target', 'unique' => FALSE, 'required' => FALSE], 'achieved' => ['type'=>'float', 'label' => 'Achieved', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Disaggregate Id
     * int(10) unsigned
     * @var int 
     */
    public $disaggregate_id;

    /**
     * Type
     * varchar(20)
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
     * Semi Period Id
     * int(10) unsigned
     * @var int 
     */
    public $semi_period_id;

    /**
     * Target
     * decimal(12,4)
     * @var float 
     */
    public $target;

    /**
     * Achieved
     * decimal(12,4)
     * @var float 
     */
    public $achieved;

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

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsdisaggregatevalues
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:08 UTC
 */

