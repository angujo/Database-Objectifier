<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setReportId(int  $report_id);
 * @method $this setDetails(string  $details);
 * @method $this setNamed(string  $named);
 * @method $this setSigned(string  $signed);
 * @method $this setDated(string  $dated);
 * @method $this setListOrder(int  $list_order);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdtaedBy(int  $updtaed_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getReportId();
 * @method string  getDetails();
 * @method string  getNamed();
 * @method string  getSigned();
 * @method string  getDated();
 * @method int  getListOrder();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdtaedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsreportsignatories extends Database\DbActive{

    CONST TABLE_NAME = 'pms_report_signatories';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'report_id' => ['type'=>'int', 'label' => 'Report Id', 'unique' => FALSE, 'required' => TRUE], 'details' => ['type'=>'string', 'label' => 'Details', 'unique' => FALSE, 'required' => TRUE], 'named' => ['type'=>'string', 'label' => 'Named', 'unique' => FALSE, 'required' => FALSE], 'signed' => ['type'=>'string', 'label' => 'Signed', 'unique' => FALSE, 'required' => FALSE], 'dated' => ['type'=>'string', 'label' => 'Dated', 'unique' => FALSE, 'required' => FALSE], 'list_order' => ['type'=>'int', 'label' => 'List Order', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updtaed_by' => ['type'=>'int', 'label' => 'Updtaed By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Report Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $report_id;

    /**
     * Details
     * (Required)
     * varchar(65)
     * @var string 
     */
    public $details;

    /**
     * Named
     * varchar(2)
     * @var string 
     */
    public $named;

    /**
     * Signed
     * varbinary(2)
     * @var string 
     */
    public $signed;

    /**
     * Dated
     * varchar(2)
     * @var string 
     */
    public $dated;

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
     * Updated
     * datetime
     * @var string 
     */
    public $updated;

    /**
     * Updtaed By
     * int(10) unsigned
     * @var int 
     */
    public $updtaed_by;

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
 * End of Class Pmsreportsignatories
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

