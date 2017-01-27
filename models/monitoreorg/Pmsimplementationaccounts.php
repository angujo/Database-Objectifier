<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setImplementationId(int  $implementation_id);
 * @method $this setAccountId(int  $account_id);
 * @method $this setBudget(float  $budget);
 * @method $this setExpenditure(float  $expenditure);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getImplementationId();
 * @method int  getAccountId();
 * @method float  getBudget();
 * @method float  getExpenditure();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsimplementationaccounts extends Database\DbActive{

    CONST TABLE_NAME = 'pms_implementation_accounts';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'implementation_id' => ['type'=>'int', 'label' => 'Implementation Id', 'unique' => FALSE, 'required' => TRUE], 'account_id' => ['type'=>'int', 'label' => 'Account Id', 'unique' => FALSE, 'required' => TRUE], 'budget' => ['type'=>'float', 'label' => 'Budget', 'unique' => FALSE, 'required' => FALSE], 'expenditure' => ['type'=>'float', 'label' => 'Expenditure', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Implementation Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $implementation_id;

    /**
     * Account Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $account_id;

    /**
     * Budget
     * decimal(12,6)
     * @var float 
     */
    public $budget;

    /**
     * Expenditure
     * decimal(12,6)
     * @var float 
     */
    public $expenditure;

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
 * End of Class Pmsimplementationaccounts
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:08 UTC
 */

