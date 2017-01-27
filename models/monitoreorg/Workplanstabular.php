<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setSupervisor(int  $supervisor);
 * @method $this setReviewStatus(string  $review_status);
 * @method $this setReverseStatus(string  $reverse_status);
 * @method $this setReviewSender(int  $review_sender);
 * @method $this setReviewRecipient(int  $review_recipient);
 * @method $this setReviewId(int  $review_id);
 * @method $this setSumTarget(float  $sum_target);
 * @method $this setSumAchieved(int  $sum_achieved);
 * @method $this setSumBudget(float  $sum_budget);
 * @method $this setSumContribution(float  $sum_contribution);
 * @method $this setSumExpenditure(int  $sum_expenditure);
 * @method $this setActivityPlan(int  $activity_plan);
 * @method $this setPeriodId(int  $period_id);
 * @method $this setActivityPlanId(int  $activity_plan_id);
 * @method $this setDated(string  $dated);
 * @method int  getId();
 * @method string  getName();
 * @method string  getDescription();
 * @method int  getSupervisor();
 * @method string  getReviewStatus();
 * @method string  getReverseStatus();
 * @method int  getReviewSender();
 * @method int  getReviewRecipient();
 * @method int  getReviewId();
 * @method float  getSumTarget();
 * @method int  getSumAchieved();
 * @method float  getSumBudget();
 * @method float  getSumContribution();
 * @method int  getSumExpenditure();
 * @method int  getActivityPlan();
 * @method int  getPeriodId();
 * @method int  getActivityPlanId();
 * @method string  getDated();
 */
class Workplanstabular extends Database\DbActive{

    CONST TABLE_NAME = 'workplanstabular';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'supervisor' => ['type'=>'int', 'label' => 'Supervisor', 'unique' => FALSE, 'required' => FALSE], 'review_status' => ['type'=>'string', 'label' => 'Review Status', 'unique' => FALSE, 'required' => FALSE], 'reverse_status' => ['type'=>'string', 'label' => 'Reverse Status', 'unique' => FALSE, 'required' => FALSE], 'review_sender' => ['type'=>'int', 'label' => 'Review Sender', 'unique' => FALSE, 'required' => FALSE], 'review_recipient' => ['type'=>'int', 'label' => 'Review Recipient', 'unique' => FALSE, 'required' => FALSE], 'review_id' => ['type'=>'int', 'label' => 'Review Id', 'unique' => FALSE, 'required' => FALSE], 'sum_target' => ['type'=>'float', 'label' => 'Sum Target', 'unique' => FALSE, 'required' => FALSE], 'sum_achieved' => ['type'=>'int', 'label' => 'Sum Achieved', 'unique' => FALSE, 'required' => TRUE], 'sum_budget' => ['type'=>'float', 'label' => 'Sum Budget', 'unique' => FALSE, 'required' => FALSE], 'sum_contribution' => ['type'=>'float', 'label' => 'Sum Contribution', 'unique' => FALSE, 'required' => FALSE], 'sum_expenditure' => ['type'=>'int', 'label' => 'Sum Expenditure', 'unique' => FALSE, 'required' => TRUE], 'activity_plan' => ['type'=>'int', 'label' => 'Activity Plan', 'unique' => FALSE, 'required' => TRUE], 'period_id' => ['type'=>'int', 'label' => 'Period Id', 'unique' => FALSE, 'required' => FALSE], 'activity_plan_id' => ['type'=>'int', 'label' => 'Activity Plan Id', 'unique' => FALSE, 'required' => TRUE], 'dated' => ['type'=>'string', 'label' => 'Dated', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * varchar(450)
     * @var string 
     */
    public $name;

    /**
     * Description
     * varchar(650)
     * @var string 
     */
    public $description;

    /**
     * Supervisor
     * int(10) unsigned
     * @var int 
     */
    public $supervisor;

    /**
     * Review Status
     * varchar(65)
     * @var string 
     */
    public $review_status;

    /**
     * Reverse Status
     * varchar(65)
     * @var string 
     */
    public $reverse_status;

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
     * Review Id
     * int(10) unsigned
     * @var int 
     */
    public $review_id;

    /**
     * Sum Target
     * decimal(34,4)
     * @var float 
     */
    public $sum_target;

    /**
     * Sum Achieved
     * (Required)
     * int(1)
     * @var int 
     */
    public $sum_achieved;

    /**
     * Sum Budget
     * decimal(38,6)
     * @var float 
     */
    public $sum_budget;

    /**
     * Sum Contribution
     * decimal(38,6)
     * @var float 
     */
    public $sum_contribution;

    /**
     * Sum Expenditure
     * (Required)
     * int(1)
     * @var int 
     */
    public $sum_expenditure;

    /**
     * Activity Plan
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $activity_plan;

    /**
     * Period Id
     * int(11) unsigned
     * @var int 
     */
    public $period_id;

    /**
     * Activity Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $activity_plan_id;

    /**
     * Dated
     * datetime
     * @var string 
     */
    public $dated;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Workplanstabular
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:12 UTC
 */

