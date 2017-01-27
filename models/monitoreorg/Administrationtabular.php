<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setPeriodId(int  $period_id);
 * @method $this setBudget(float  $budget);
 * @method $this setContribution(float  $contribution);
 * @method $this setExpenditure(float  $expenditure);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setReviewSender(int  $review_sender);
 * @method $this setReviewRecipient(int  $review_recipient);
 * @method $this setReviewStatus(string  $review_status);
 * @method $this setReviewId(int  $review_id);
 * @method int  getId();
 * @method string  getName();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method int  getPeriodId();
 * @method float  getBudget();
 * @method float  getContribution();
 * @method float  getExpenditure();
 * @method int  getStructureId();
 * @method int  getReviewSender();
 * @method int  getReviewRecipient();
 * @method string  getReviewStatus();
 * @method int  getReviewId();
 */
class Administrationtabular extends Database\DbActive{

    CONST TABLE_NAME = 'administrationtabular';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => TRUE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => TRUE], 'period_id' => ['type'=>'int', 'label' => 'Period Id', 'unique' => FALSE, 'required' => TRUE], 'budget' => ['type'=>'float', 'label' => 'Budget', 'unique' => FALSE, 'required' => FALSE], 'contribution' => ['type'=>'float', 'label' => 'Contribution', 'unique' => FALSE, 'required' => FALSE], 'expenditure' => ['type'=>'float', 'label' => 'Expenditure', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'review_sender' => ['type'=>'int', 'label' => 'Review Sender', 'unique' => FALSE, 'required' => FALSE], 'review_recipient' => ['type'=>'int', 'label' => 'Review Recipient', 'unique' => FALSE, 'required' => FALSE], 'review_status' => ['type'=>'string', 'label' => 'Review Status', 'unique' => FALSE, 'required' => FALSE], 'review_id' => ['type'=>'int', 'label' => 'Review Id', 'unique' => FALSE, 'required' => FALSE]];

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
     * decimal(34,6)
     * @var float 
     */
    public $expenditure;

    /**
     * Structure Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $structure_id;

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
     * Review Status
     * varchar(65)
     * @var string 
     */
    public $review_status;

    /**
     * Review Id
     * int(10) unsigned
     * @var int 
     */
    public $review_id;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Administrationtabular
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:06 UTC
 */

