<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setRowId(int  $row_id);
 * @method $this setAction(string  $action);
 * @method $this setActionUser(int  $action_user);
 * @method $this setTableName(string  $table_name);
 * @method $this setEventDate(string  $event_date);
 * @method int  getId();
 * @method int  getRowId();
 * @method string  getAction();
 * @method int  getActionUser();
 * @method string  getTableName();
 * @method string  getEventDate();
 */
class Monitoreorgevents extends Database\DbActive{

    CONST TABLE_NAME = 'monitore_org_events';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'row_id' => ['type'=>'int', 'label' => 'Row Id', 'unique' => FALSE, 'required' => FALSE], 'action' => ['type'=>'string', 'label' => 'Action', 'unique' => FALSE, 'required' => FALSE], 'action_user' => ['type'=>'int', 'label' => 'Action User', 'unique' => FALSE, 'required' => FALSE], 'table_name' => ['type'=>'string', 'label' => 'Table Name', 'unique' => FALSE, 'required' => FALSE], 'event_date' => ['type'=>'string', 'label' => 'Event Date', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Row Id
     * int(11)
     * @var int 
     */
    public $row_id;

    /**
     * Action
     * varchar(200)
     * @var string 
     */
    public $action;

    /**
     * Action User
     * int(11)
     * @var int 
     */
    public $action_user;

    /**
     * Table Name
     * varchar(250)
     * @var string 
     */
    public $table_name;

    /**
     * Event Date
     * datetime
     * @var string 
     */
    public $event_date;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Monitoreorgevents
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:08 UTC
 */

