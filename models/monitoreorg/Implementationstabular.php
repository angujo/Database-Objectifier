<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setIndicatorName(string  $indicator_name);
 * @method $this setIndicatorId(int  $indicator_id);
 * @method $this setName(string  $name);
 * @method $this setId(int  $id);
 * @method $this setWorkPlanId(int  $work_plan_id);
 * @method $this setActivityPlanId(int  $activity_plan_id);
 * @method $this setSupervisorId(int  $supervisor_id);
 * @method $this setStartDate(string  $start_date);
 * @method $this setEndDate(string  $end_date);
 * @method $this setWorkplanName(string  $workplan_name);
 * @method $this setBudget(float  $budget);
 * @method $this setExpenditure(float  $expenditure);
 * @method $this setReviewStatus(string  $review_status);
 * @method $this setReviewSender(int  $review_sender);
 * @method $this setReviewRecipient(int  $review_recipient);
 * @method $this setTarget(float  $target);
 * @method $this setAchieved(float  $achieved);
 * @method string  getIndicatorName();
 * @method int  getIndicatorId();
 * @method string  getName();
 * @method int  getId();
 * @method int  getWorkPlanId();
 * @method int  getActivityPlanId();
 * @method int  getSupervisorId();
 * @method string  getStartDate();
 * @method string  getEndDate();
 * @method string  getWorkplanName();
 * @method float  getBudget();
 * @method float  getExpenditure();
 * @method string  getReviewStatus();
 * @method int  getReviewSender();
 * @method int  getReviewRecipient();
 * @method float  getTarget();
 * @method float  getAchieved();
 */
class Implementationstabular extends Database\DbActive{

    CONST TABLE_NAME = 'implementationstabular';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['indicator_name' => ['type'=>'string', 'label' => 'Indicator Name', 'unique' => FALSE, 'required' => FALSE], 'indicator_id' => ['type'=>'int', 'label' => 'Indicator Id', 'unique' => FALSE, 'required' => TRUE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'work_plan_id' => ['type'=>'int', 'label' => 'Work Plan Id', 'unique' => FALSE, 'required' => TRUE], 'activity_plan_id' => ['type'=>'int', 'label' => 'Activity Plan Id', 'unique' => FALSE, 'required' => TRUE], 'supervisor_id' => ['type'=>'int', 'label' => 'Supervisor Id', 'unique' => FALSE, 'required' => TRUE], 'start_date' => ['type'=>'string', 'label' => 'Start Date', 'unique' => FALSE, 'required' => TRUE], 'end_date' => ['type'=>'string', 'label' => 'End Date', 'unique' => FALSE, 'required' => TRUE], 'workplan_name' => ['type'=>'string', 'label' => 'Workplan Name', 'unique' => FALSE, 'required' => FALSE], 'budget' => ['type'=>'float', 'label' => 'Budget', 'unique' => FALSE, 'required' => FALSE], 'expenditure' => ['type'=>'float', 'label' => 'Expenditure', 'unique' => FALSE, 'required' => FALSE], 'review_status' => ['type'=>'string', 'label' => 'Review Status', 'unique' => FALSE, 'required' => FALSE], 'review_sender' => ['type'=>'int', 'label' => 'Review Sender', 'unique' => FALSE, 'required' => FALSE], 'review_recipient' => ['type'=>'int', 'label' => 'Review Recipient', 'unique' => FALSE, 'required' => FALSE], 'target' => ['type'=>'float', 'label' => 'Target', 'unique' => FALSE, 'required' => FALSE], 'achieved' => ['type'=>'float', 'label' => 'Achieved', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Indicator Name
     * varchar(450)
     * @var string 
     */
    public $indicator_name;

    /**
     * Indicator Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $indicator_id;

    /**
     * Name
     * varchar(255)
     * @var string 
     */
    public $name;

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Work Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $work_plan_id;

    /**
     * Activity Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $activity_plan_id;

    /**
     * Supervisor Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $supervisor_id;

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
     * Workplan Name
     * varchar(450)
     * @var string 
     */
    public $workplan_name;

    /**
     * Budget
     * decimal(34,6)
     * @var float 
     */
    public $budget;

    /**
     * Expenditure
     * decimal(34,6)
     * @var float 
     */
    public $expenditure;

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
     * Target
     * decimal(34,4)
     * @var float 
     */
    public $target;

    /**
     * Achieved
     * decimal(34,4)
     * @var float 
     */
    public $achieved;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Implementationstabular
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:06 UTC
 */

