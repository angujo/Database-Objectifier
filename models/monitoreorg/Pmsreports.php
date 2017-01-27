<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setTitle(string  $title);
 * @method $this setSubTitle(string  $sub_title);
 * @method $this setHeaderDetails(string  $header_details);
 * @method $this setFooterDetails(string  $footer_details);
 * @method $this setAccess(string  $access);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setAppend(string  $append);
 * @method $this setDescription(string  $description);
 * @method $this setIndicateStructure(string  $indicate_structure);
 * @method $this setIndicatePeriod(string  $indicate_period);
 * @method $this setIndicateOffice(string  $indicate_office);
 * @method $this setIndicateLevel(string  $indicate_level);
 * @method $this setIndicateFilter(string  $indicate_filter);
 * @method $this setIndicateYear(string  $indicate_year);
 * @method $this setSignable(string  $signable);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method $this setDeleted(string  $deleted);
 * @method int  getId();
 * @method string  getName();
 * @method string  getTitle();
 * @method string  getSubTitle();
 * @method string  getHeaderDetails();
 * @method string  getFooterDetails();
 * @method string  getAccess();
 * @method int  getStructureId();
 * @method string  getAppend();
 * @method string  getDescription();
 * @method string  getIndicateStructure();
 * @method string  getIndicatePeriod();
 * @method string  getIndicateOffice();
 * @method string  getIndicateLevel();
 * @method string  getIndicateFilter();
 * @method string  getIndicateYear();
 * @method string  getSignable();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method int  getDeletedBy();
 * @method string  getDeleted();
 */
class Pmsreports extends Database\DbActive{

    CONST TABLE_NAME = 'pms_reports';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => TRUE], 'title' => ['type'=>'string', 'label' => 'Title', 'unique' => FALSE, 'required' => FALSE], 'sub_title' => ['type'=>'string', 'label' => 'Sub Title', 'unique' => FALSE, 'required' => FALSE], 'header_details' => ['type'=>'string', 'label' => 'Header Details', 'unique' => FALSE, 'required' => FALSE], 'footer_details' => ['type'=>'string', 'label' => 'Footer Details', 'unique' => FALSE, 'required' => FALSE], 'access' => ['type'=>'string', 'label' => 'Access', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => FALSE], 'append' => ['type'=>'string', 'label' => 'Append', 'unique' => FALSE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'indicate_structure' => ['type'=>'string', 'label' => 'Indicate Structure', 'unique' => FALSE, 'required' => FALSE], 'indicate_period' => ['type'=>'string', 'label' => 'Indicate Period', 'unique' => FALSE, 'required' => FALSE], 'indicate_office' => ['type'=>'string', 'label' => 'Indicate Office', 'unique' => FALSE, 'required' => FALSE], 'indicate_level' => ['type'=>'string', 'label' => 'Indicate Level', 'unique' => FALSE, 'required' => FALSE], 'indicate_filter' => ['type'=>'string', 'label' => 'Indicate Filter', 'unique' => FALSE, 'required' => FALSE], 'indicate_year' => ['type'=>'string', 'label' => 'Indicate Year', 'unique' => FALSE, 'required' => FALSE], 'signable' => ['type'=>'string', 'label' => 'Signable', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE]];

    /**
     * Id
     * int(10) unsigned
     * @var int 
     */
    public $id;

    /**
     * Name
     * (Required)
     * varchar(120)
     * @var string 
     */
    public $name;

    /**
     * Title
     * varchar(250)
     * @var string 
     */
    public $title;

    /**
     * Sub Title
     * varchar(350)
     * @var string 
     */
    public $sub_title;

    /**
     * Header Details
     * varchar(1000)
     * @var string 
     */
    public $header_details;

    /**
     * Footer Details
     * varchar(1000)
     * @var string 
     */
    public $footer_details;

    /**
     * Access
     * varchar(25)
     * @var string 
     */
    public $access;

    /**
     * Structure Id
     * int(11) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * Append
     * varchar(5)
     * @var string 
     */
    public $append;

    /**
     * Description
     * varchar(1000)
     * @var string 
     */
    public $description;

    /**
     * Indicate Structure
     * varchar(5)
     * @var string 
     */
    public $indicate_structure;

    /**
     * Indicate Period
     * varchar(5)
     * @var string 
     */
    public $indicate_period;

    /**
     * Indicate Office
     * varchar(5)
     * @var string 
     */
    public $indicate_office;

    /**
     * Indicate Level
     * varchar(5)
     * @var string 
     */
    public $indicate_level;

    /**
     * Indicate Filter
     * varchar(5)
     * @var string 
     */
    public $indicate_filter;

    /**
     * Indicate Year
     * varchar(2)
     * @var string 
     */
    public $indicate_year;

    /**
     * Signable
     * varchar(2)
     * @var string 
     */
    public $signable;

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
     * Deleted By
     * int(10) unsigned
     * @var int 
     */
    public $deleted_by;

    /**
     * Deleted
     * datetime
     * @var string 
     */
    public $deleted;

     /* function __construct($conditions=FALSE){
        parent::__construct($conditions);
    } */

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportfilters[]
     */
    function getPmsreportfilters($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportfilters[] $_e */
        $_e = $this->PDOBuild->table('pms_report_filters', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportfilters');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsreportfilters(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_filters','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsections[]
     */
    function getPmsreportsections($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsections[] $_e */
        $_e = $this->PDOBuild->table('pms_report_sections', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsections');
        return $_e;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsectioncolumns[]
     */
    function getPmsreportsectioncolumns($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->joinInner('pms_report_sections tbl1', 'tbl1.id = t_tbl.section_id')
            ->where('tbl1.report_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsectioncolumns[] $_e */
        $_e = $this->PDOBuild->table('pms_report_section_columns', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsectioncolumns');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsreportsections(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_sections','t_tbl')->count();
    }

    /**
     * @return int
     */
    function countPmsreportsectioncolumns(){
        if(!$this->id) return 0;
        $this->PDOBuild->joinInner('pms_report_sections tbl1', 'tbl1.id = t_tbl.section_id')
            ->where('tbl1.report_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_section_columns','t_tbl')->count();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Pmsreportsignatories[]
     */
    function getPmsreportsignatories($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsignatories[] $_e */
        $_e = $this->PDOBuild->table('pms_report_signatories', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsignatories');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsreportsignatories(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.report_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_signatories','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsreports
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

