<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setProjectedBudget(float  $projected_budget);
 * @method $this setSumExpenditure(float  $sum_expenditure);
 * @method $this setReviewDate(string  $review_date);
 * @method $this setReviewOffice(int  $review_office);
 * @method $this setReviewStatus(string  $review_status);
 * @method $this setReviewSender(int  $review_sender);
 * @method $this setReviewRecipient(int  $review_recipient);
 * @method $this setPeriodId(int  $period_id);
 * @method $this setSumBudget(float  $sum_budget);
 * @method $this setSumContribution(float  $sum_contribution);
 * @method $this setSumTarget(float  $sum_target);
 * @method $this setSumAchieved(float  $sum_achieved);
 * @method $this setReviewId(int  $review_id);
 * @method $this setId(int  $id);
 * @method $this setActivityPlanId(int  $activity_plan_id);
 * @method $this setIndicatorId(int  $indicator_id);
 * @method $this setSupervisor(int  $supervisor);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setAccessibility(string  $accessibility);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method float  getProjectedBudget();
 * @method float  getSumExpenditure();
 * @method string  getReviewDate();
 * @method int  getReviewOffice();
 * @method string  getReviewStatus();
 * @method int  getReviewSender();
 * @method int  getReviewRecipient();
 * @method int  getPeriodId();
 * @method float  getSumBudget();
 * @method float  getSumContribution();
 * @method float  getSumTarget();
 * @method float  getSumAchieved();
 * @method int  getReviewId();
 * @method int  getId();
 * @method int  getActivityPlanId();
 * @method int  getIndicatorId();
 * @method int  getSupervisor();
 * @method string  getName();
 * @method string  getDescription();
 * @method string  getAccessibility();
 * @method int  getStructureId();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Workplanreview extends Database\DbActive{

    CONST TABLE_NAME = 'workplanreview';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['projected_budget' => ['type'=>'float', 'label' => 'Projected Budget', 'unique' => FALSE, 'required' => FALSE], 'sum_expenditure' => ['type'=>'float', 'label' => 'Sum Expenditure', 'unique' => FALSE, 'required' => FALSE], 'review_date' => ['type'=>'string', 'label' => 'Review Date', 'unique' => FALSE, 'required' => FALSE], 'review_office' => ['type'=>'int', 'label' => 'Review Office', 'unique' => FALSE, 'required' => FALSE], 'review_status' => ['type'=>'string', 'label' => 'Review Status', 'unique' => FALSE, 'required' => FALSE], 'review_sender' => ['type'=>'int', 'label' => 'Review Sender', 'unique' => FALSE, 'required' => FALSE], 'review_recipient' => ['type'=>'int', 'label' => 'Review Recipient', 'unique' => FALSE, 'required' => FALSE], 'period_id' => ['type'=>'int', 'label' => 'Period Id', 'unique' => FALSE, 'required' => FALSE], 'sum_budget' => ['type'=>'float', 'label' => 'Sum Budget', 'unique' => FALSE, 'required' => FALSE], 'sum_contribution' => ['type'=>'float', 'label' => 'Sum Contribution', 'unique' => FALSE, 'required' => FALSE], 'sum_target' => ['type'=>'float', 'label' => 'Sum Target', 'unique' => FALSE, 'required' => FALSE], 'sum_achieved' => ['type'=>'float', 'label' => 'Sum Achieved', 'unique' => FALSE, 'required' => FALSE], 'review_id' => ['type'=>'int', 'label' => 'Review Id', 'unique' => FALSE, 'required' => FALSE], 'id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'activity_plan_id' => ['type'=>'int', 'label' => 'Activity Plan Id', 'unique' => FALSE, 'required' => TRUE], 'indicator_id' => ['type'=>'int', 'label' => 'Indicator Id', 'unique' => FALSE, 'required' => TRUE], 'supervisor' => ['type'=>'int', 'label' => 'Supervisor', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'accessibility' => ['type'=>'string', 'label' => 'Accessibility', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Projected Budget
     * decimal(34,6)
     * @var float 
     */
    public $projected_budget;

    /**
     * Sum Expenditure
     * decimal(34,6)
     * @var float 
     */
    public $sum_expenditure;

    /**
     * Review Date
     * datetime
     * @var string 
     */
    public $review_date;

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
     * Period Id
     * int(11) unsigned
     * @var int 
     */
    public $period_id;

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
     * Sum Target
     * decimal(34,4)
     * @var float 
     */
    public $sum_target;

    /**
     * Sum Achieved
     * decimal(34,4)
     * @var float 
     */
    public $sum_achieved;

    /**
     * Review Id
     * int(10) unsigned
     * @var int 
     */
    public $review_id;

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Activity Plan Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $activity_plan_id;

    /**
     * Indicator Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $indicator_id;

    /**
     * Supervisor
     * int(10) unsigned
     * @var int 
     */
    public $supervisor;

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
     * Accessibility
     * varchar(20)
     * @var string 
     */
    public $accessibility;

    /**
     * Structure Id
     * int(11) unsigned
     * @var int 
     */
    public $structure_id;

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
 * End of Class Workplanreview
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:12 UTC
 */

