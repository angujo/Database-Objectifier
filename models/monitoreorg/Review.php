<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setType(string  $type);
 * @method $this setReferenceId(int  $reference_id);
 * @method $this setNote(string  $note);
 * @method $this setSender(int  $sender);
 * @method $this setRecipient(int  $recipient);
 * @method $this setStatus(string  $status);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method $this setReverseStatus(string  $reverse_status);
 * @method $this setSenderName(string  $sender_name);
 * @method $this setRecipientName(string  $recipient_name);
 * @method int  getId();
 * @method string  getType();
 * @method int  getReferenceId();
 * @method string  getNote();
 * @method int  getSender();
 * @method int  getRecipient();
 * @method string  getStatus();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 * @method string  getReverseStatus();
 * @method string  getSenderName();
 * @method string  getRecipientName();
 */
class Review extends Database\DbActive{

    CONST TABLE_NAME = 'review';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => TRUE], 'reference_id' => ['type'=>'int', 'label' => 'Reference Id', 'unique' => FALSE, 'required' => TRUE], 'note' => ['type'=>'string', 'label' => 'Note', 'unique' => FALSE, 'required' => TRUE], 'sender' => ['type'=>'int', 'label' => 'Sender', 'unique' => FALSE, 'required' => FALSE], 'recipient' => ['type'=>'int', 'label' => 'Recipient', 'unique' => FALSE, 'required' => FALSE], 'status' => ['type'=>'string', 'label' => 'Status', 'unique' => FALSE, 'required' => TRUE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE], 'reverse_status' => ['type'=>'string', 'label' => 'Reverse Status', 'unique' => FALSE, 'required' => FALSE], 'sender_name' => ['type'=>'string', 'label' => 'Sender Name', 'unique' => FALSE, 'required' => TRUE], 'recipient_name' => ['type'=>'string', 'label' => 'Recipient Name', 'unique' => FALSE, 'required' => TRUE]];

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
     * Reference Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $reference_id;

    /**
     * Note
     * (Required)
     * text
     * @var string 
     */
    public $note;

    /**
     * Sender
     * int(10) unsigned
     * @var int 
     */
    public $sender;

    /**
     * Recipient
     * int(10) unsigned
     * @var int 
     */
    public $recipient;

    /**
     * Status
     * (Required)
     * varchar(65)
     * @var string 
     */
    public $status;

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

    /**
     * Reverse Status
     * varchar(65)
     * @var string 
     */
    public $reverse_status;

    /**
     * Sender Name
     * (Required)
     * varchar(450)
     * @var string 
     */
    public $sender_name;

    /**
     * Recipient Name
     * (Required)
     * varchar(450)
     * @var string 
     */
    public $recipient_name;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Review
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

