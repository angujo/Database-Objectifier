<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setSectionId(int  $section_id);
 * @method $this setName(string  $name);
 * @method $this setDataColumn(string  $data_column);
 * @method $this setListOrder(int  $list_order);
 * @method $this setCalculation(string  $calculation);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method int  getSectionId();
 * @method string  getName();
 * @method string  getDataColumn();
 * @method int  getListOrder();
 * @method string  getCalculation();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsreportsectioncolumns extends Database\DbActive{

    CONST TABLE_NAME = 'pms_report_section_columns';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'section_id' => ['type'=>'int', 'label' => 'Section Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'data_column' => ['type'=>'string', 'label' => 'Data Column', 'unique' => FALSE, 'required' => FALSE], 'list_order' => ['type'=>'int', 'label' => 'List Order', 'unique' => FALSE, 'required' => FALSE], 'calculation' => ['type'=>'string', 'label' => 'Calculation', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Section Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $section_id;

    /**
     * Name
     * varchar(36)
     * @var string 
     */
    public $name;

    /**
     * Data Column
     * varchar(450)
     * @var string 
     */
    public $data_column;

    /**
     * List Order
     * int(11)
     * @var int 
     */
    public $list_order;

    /**
     * Calculation
     * varchar(650)
     * @var string 
     */
    public $calculation;

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
 * End of Class Pmsreportsectioncolumns
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

