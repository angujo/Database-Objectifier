<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setInstanceId(int  $instance_id);
 * @method $this setQuestionId(int  $question_id);
 * @method $this setAnswerText(string  $answer_text);
 * @method $this setAnswerOption(int  $answer_option);
 * @method $this setAnswerNumeric(float  $answer_numeric);
 * @method $this setAnswerMultiple(string  $answer_multiple);
 * @method int  getId();
 * @method int  getInstanceId();
 * @method int  getQuestionId();
 * @method string  getAnswerText();
 * @method int  getAnswerOption();
 * @method float  getAnswerNumeric();
 * @method string  getAnswerMultiple();
 */
class Svyanswers extends Database\DbActive{

    CONST TABLE_NAME = 'svy_answers';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'instance_id' => ['type'=>'int', 'label' => 'Instance Id', 'unique' => FALSE, 'required' => TRUE], 'question_id' => ['type'=>'int', 'label' => 'Question Id', 'unique' => FALSE, 'required' => TRUE], 'answer_text' => ['type'=>'string', 'label' => 'Answer Text', 'unique' => FALSE, 'required' => FALSE], 'answer_option' => ['type'=>'int', 'label' => 'Answer Option', 'unique' => FALSE, 'required' => FALSE], 'answer_numeric' => ['type'=>'float', 'label' => 'Answer Numeric', 'unique' => FALSE, 'required' => FALSE], 'answer_multiple' => ['type'=>'string', 'label' => 'Answer Multiple', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Instance Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $instance_id;

    /**
     * Question Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $question_id;

    /**
     * Answer Text
     * text
     * @var string 
     */
    public $answer_text;

    /**
     * Answer Option
     * int(11)
     * @var int 
     */
    public $answer_option;

    /**
     * Answer Numeric
     * decimal(12,4)
     * @var float 
     */
    public $answer_numeric;

    /**
     * Answer Multiple
     * varchar(700)
     * @var string 
     */
    public $answer_multiple;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Svyanswers
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:11 UTC
 */

