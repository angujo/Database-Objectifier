<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setCategory(string  $category);
 * @method $this setCategoryReference(int  $category_reference);
 * @method $this setSubreferenced(int  $subreferenced);
 * @method $this setTypeId(int  $type_id);
 * @method $this setCodeGroupId(int  $code_group_id);
 * @method $this setName(string  $name);
 * @method $this setDescription(string  $description);
 * @method $this setCode(string  $code);
 * @method $this setCompulsory(string  $compulsory);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getCategory();
 * @method int  getCategoryReference();
 * @method int  getSubreferenced();
 * @method int  getTypeId();
 * @method int  getCodeGroupId();
 * @method string  getName();
 * @method string  getDescription();
 * @method string  getCode();
 * @method string  getCompulsory();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsaccounts extends Database\DbActive{

    CONST TABLE_NAME = 'pms_accounts';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'category' => ['type'=>'string', 'label' => 'Category', 'unique' => FALSE, 'required' => TRUE], 'category_reference' => ['type'=>'int', 'label' => 'Category Reference', 'unique' => FALSE, 'required' => TRUE], 'subreferenced' => ['type'=>'int', 'label' => 'Subreferenced', 'unique' => FALSE, 'required' => FALSE], 'type_id' => ['type'=>'int', 'label' => 'Type Id', 'unique' => FALSE, 'required' => TRUE], 'code_group_id' => ['type'=>'int', 'label' => 'Code Group Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'code' => ['type'=>'string', 'label' => 'Code', 'unique' => FALSE, 'required' => FALSE], 'compulsory' => ['type'=>'string', 'label' => 'Compulsory', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Category
     * (Required)
     * varchar(45)
     * @var string 
     */
    public $category;

    /**
     * Category Reference
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $category_reference;

    /**
     * Subreferenced
     * int(11)
     * @var int 
     */
    public $subreferenced;

    /**
     * Type Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $type_id;

    /**
     * Code Group Id
     * int(10) unsigned
     * @var int 
     */
    public $code_group_id;

    /**
     * Name
     * (Required)
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
     * Code
     * varchar(120)
     * @var string 
     */
    public $code;

    /**
     * Compulsory
     * varchar(2)
     * @var string 
     */
    public $compulsory;

    /**
     * Created
     * datetime
     * @var string 
     */
    public $created;

    /**
     * Created By
     * int(11)
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
     * int(11)
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
     * int(11)
     * @var int 
     */
    public $deleted_by;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadminbudgets[]
     */
    function getPmsadminbudgets($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadminbudgets[] $_e */
        $_e = $this->PDOBuild->table('pms_admin_budgets', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadminbudgets');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsadminbudgets(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        return $this->PDOBuild->table('pms_admin_budgets','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsadministrationaccounts[]
     */
    function getPmsadministrationaccounts($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsadministrationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_administration_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsadministrationaccounts');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsadministrationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        return $this->PDOBuild->table('pms_administration_accounts','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsimplementationaccounts[]
     */
    function getPmsimplementationaccounts($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsimplementationaccounts[] $_e */
        $_e = $this->PDOBuild->table('pms_implementation_accounts', 't_tbl')->getAll('\Database\Monitoreorg\Pmsimplementationaccounts');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsimplementationaccounts(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        return $this->PDOBuild->table('pms_implementation_accounts','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsworkplanbudget[]
     */
    function getPmsworkplanbudget($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsworkplanbudget[] $_e */
        $_e = $this->PDOBuild->table('pms_workplan_budget', 't_tbl')->getAll('\Database\Monitoreorg\Pmsworkplanbudget');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsworkplanbudget(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.account_id', (int)$this->id);
        return $this->PDOBuild->table('pms_workplan_budget','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsaccounts
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:08 UTC
 */

