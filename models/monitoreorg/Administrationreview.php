<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setPeriodId(int  $period_id);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setClosingNote(string  $closing_note);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method $this setReviewOffice(int  $review_office);
 * @method $this setReviewStatus(string  $review_status);
 * @method $this setReviewSender(int  $review_sender);
 * @method $this setReviewRecipient(int  $review_recipient);
 * @method $this setReviewDate(string  $review_date);
 * @method $this setBudget(float  $budget);
 * @method $this setContribution(float  $contribution);
 * @method $this setExpenditure(int  $expenditure);
 * @method int  getId();
 * @method string  getName();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method int  getPeriodId();
 * @method int  getSupervisorId();
 * @method int  getStructureId();
 * @method string  getClosingNote();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 * @method int  getReviewOffice();
 * @method string  getReviewStatus();
 * @method int  getReviewSender();
 * @method int  getReviewRecipient();
 * @method string  getReviewDate();
 * @method float  getBudget();
 * @method float  getContribution();
 * @method int  getExpenditure();
 */
class Administrationreview extends Database\DbActive{

    CONST TABLE_NAME = 'administrationreview';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => TRUE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => TRUE], 'period_id' => ['type'=>'int', 'label' => 'Period Id', 'unique' => FALSE, 'required' => TRUE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => TRUE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'closing_note' => ['type'=>'string', 'label' => 'Closing Note', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE], 'review_office' => ['type'=>'int', 'label' => 'Review Office', 'unique' => FALSE, 'required' => FALSE], 'review_status' => ['type'=>'string', 'label' => 'Review Status', 'unique' => FALSE, 'required' => FALSE], 'review_sender' => ['type'=>'int', 'label' => 'Review Sender', 'unique' => FALSE, 'required' => FALSE], 'review_recipient' => ['type'=>'int', 'label' => 'Review Recipient', 'unique' => FALSE, 'required' => FALSE], 'review_date' => ['type'=>'string', 'label' => 'Review Date', 'unique' => FALSE, 'required' => FALSE], 'budget' => ['type'=>'float', 'label' => 'Budget', 'unique' => FALSE, 'required' => FALSE], 'contribution' => ['type'=>'float', 'label' => 'Contribution', 'unique' => FALSE, 'required' => FALSE], 'expenditure' => ['type'=>'int', 'label' => 'Expenditure', 'unique' => FALSE, 'required' => TRUE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * (Required)
     * varchar(850)
     * @var string 
     */
    public $name;

    /**
     * Start Date
     * (Required)
     * date
     * @var string 
     */
    public $start_date;

    /**
     * End Date
     * (Required)
     * date
     * @var string 
     */
    public $end_date;

    /**
     * Period Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $period_id;

    /**
     * Supervisor Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $supervisor_id;

    /**
     * Structure Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Closing Note
     * text
     * @var string 
     */
    public $closing_note;

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
     * Review Office
     * int(10) unsigned
     * @var int 
     */
    public $review_office;

    /**
     * Review Status
     * varchar(65)
     * @var string 
     */
    public $review_status;

    /**
     * Review Sender
     * int(10) unsigned
     * @var int 
     */
    public $review_sender;

    /**
     * Review Recipient
     * int(10) unsigned
     * @var int 
     */
    public $review_recipient;

    /**
     * Review Date
     * datetime
     * @var string 
     */
    public $review_date;

    /**
     * Budget
     * decimal(34,6)
     * @var float 
     */
    public $budget;

    /**
     * Contribution
     * decimal(34,6)
     * @var float 
     */
    public $contribution;

    /**
     * Expenditure
     * (Required)
     * int(1)
     * @var int 
     */
    public $expenditure;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Administrationreview
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:05 UTC
 */

