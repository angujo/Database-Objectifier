<?php 

namespace Database\Monitoreorg;

use Database;

/**
 * @method $this setId(int  $id);
 * @method $this setName(string  $name);
 * @method $this setReportId(int  $report_id);
 * @method $this setSelectable(string  $selectable);
 * @method $this setSummable(string  $summable);
 * @method $this setFilterType(string  $filter_type);
 * @method $this setFilterBy(int  $filter_by);
 * @method $this setTitle(string  $title);
 * @method $this setType(string  $type);
 * @method $this setBargraphColumns(string  $bargraph_columns);
 * @method $this setLinegraphColumns(string  $linegraph_columns);
 * @method $this setColumnsOrdering(string  $columns_ordering);
 * @method $this setStructureId(int  $structure_id);
 * @method $this setListOrder(int  $list_order);
 * @method $this setDescription(string  $description);
 * @method $this setSemiPeriod(string  $semi_period);
 * @method $this setCreated(string  $created);
 * @method $this setCreatedBy(int  $created_by);
 * @method $this setUpdated(string  $updated);
 * @method $this setUpdatedBy(int  $updated_by);
 * @method $this setUpdatedOn(string  $updated_on);
 * @method $this setDeleted(string  $deleted);
 * @method $this setDeletedBy(int  $deleted_by);
 * @method int  getId();
 * @method string  getName();
 * @method int  getReportId();
 * @method string  getSelectable();
 * @method string  getSummable();
 * @method string  getFilterType();
 * @method int  getFilterBy();
 * @method string  getTitle();
 * @method string  getType();
 * @method string  getBargraphColumns();
 * @method string  getLinegraphColumns();
 * @method string  getColumnsOrdering();
 * @method int  getStructureId();
 * @method int  getListOrder();
 * @method string  getDescription();
 * @method string  getSemiPeriod();
 * @method string  getCreated();
 * @method int  getCreatedBy();
 * @method string  getUpdated();
 * @method int  getUpdatedBy();
 * @method string  getUpdatedOn();
 * @method string  getDeleted();
 * @method int  getDeletedBy();
 */
class Pmsreportsections extends Database\DbActive{

    CONST TABLE_NAME = 'pms_report_sections';

    CONST DB_NAME = 'monitore_org';

    protected static $DETAILS = ['id' => ['type'=>'int', 'label' => 'Id', 'unique' => FALSE, 'required' => FALSE], 'name' => ['type'=>'string', 'label' => 'Name', 'unique' => FALSE, 'required' => FALSE], 'report_id' => ['type'=>'int', 'label' => 'Report Id', 'unique' => FALSE, 'required' => TRUE], 'selectable' => ['type'=>'string', 'label' => 'Selectable', 'unique' => FALSE, 'required' => FALSE], 'summable' => ['type'=>'string', 'label' => 'Summable', 'unique' => FALSE, 'required' => FALSE], 'filter_type' => ['type'=>'string', 'label' => 'Filter Type', 'unique' => FALSE, 'required' => FALSE], 'filter_by' => ['type'=>'int', 'label' => 'Filter By', 'unique' => FALSE, 'required' => FALSE], 'title' => ['type'=>'string', 'label' => 'Title', 'unique' => FALSE, 'required' => FALSE], 'type' => ['type'=>'string', 'label' => 'Type', 'unique' => FALSE, 'required' => TRUE], 'bargraph_columns' => ['type'=>'string', 'label' => 'Bargraph Columns', 'unique' => FALSE, 'required' => FALSE], 'linegraph_columns' => ['type'=>'string', 'label' => 'Linegraph Columns', 'unique' => FALSE, 'required' => FALSE], 'columns_ordering' => ['type'=>'string', 'label' => 'Columns Ordering', 'unique' => FALSE, 'required' => FALSE], 'structure_id' => ['type'=>'int', 'label' => 'Structure Id', 'unique' => FALSE, 'required' => TRUE], 'list_order' => ['type'=>'int', 'label' => 'List Order', 'unique' => FALSE, 'required' => FALSE], 'description' => ['type'=>'string', 'label' => 'Description', 'unique' => FALSE, 'required' => FALSE], 'semi_period' => ['type'=>'string', 'label' => 'Semi Period', 'unique' => FALSE, 'required' => FALSE], 'created' => ['type'=>'string', 'label' => 'Created', 'unique' => FALSE, 'required' => FALSE], 'created_by' => ['type'=>'int', 'label' => 'Created By', 'unique' => FALSE, 'required' => FALSE], 'updated' => ['type'=>'string', 'label' => 'Updated', 'unique' => FALSE, 'required' => FALSE], 'updated_by' => ['type'=>'int', 'label' => 'Updated By', 'unique' => FALSE, 'required' => FALSE], 'updated_on' => ['type'=>'string', 'label' => 'Updated On', 'unique' => FALSE, 'required' => FALSE], 'deleted' => ['type'=>'string', 'label' => 'Deleted', 'unique' => FALSE, 'required' => FALSE], 'deleted_by' => ['type'=>'int', 'label' => 'Deleted By', 'unique' => FALSE, 'required' => FALSE]];

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
     * Report Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $report_id;

    /**
     * Selectable
     * varchar(4)
     * @var string 
     */
    public $selectable;

    /**
     * Summable
     * varchar(2)
     * @var string 
     */
    public $summable;

    /**
     * Filter Type
     * varchar(54)
     * @var string 
     */
    public $filter_type;

    /**
     * Filter By
     * int(11)
     * @var int 
     */
    public $filter_by;

    /**
     * Title
     * varchar(250)
     * @var string 
     */
    public $title;

    /**
     * Type
     * (Required)
     * varchar(120)
     * @var string 
     */
    public $type;

    /**
     * Bargraph Columns
     * varchar(1500)
     * @var string 
     */
    public $bargraph_columns;

    /**
     * Linegraph Columns
     * varchar(1500)
     * @var string 
     */
    public $linegraph_columns;

    /**
     * Columns Ordering
     * varchar(1500)
     * @var string 
     */
    public $columns_ordering;

    /**
     * Structure Id
     * (Required)
     * int(10) unsigned
     * @var int 
     */
    public $structure_id;

    /**
     * List Order
     * int(11)
     * @var int 
     */
    public $list_order;

    /**
     * Description
     * varchar(1000)
     * @var string 
     */
    public $description;

    /**
     * Semi Period
     * varchar(2)
     * @var string 
     */
    public $semi_period;

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
     * Updated On
     * datetime
     * @var string 
     */
    public $updated_on;

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
     * @return Pmsreportsectioncolumns[]
     */
    function getPmsreportsectioncolumns($limit = NULL, $offset = 0){
        if(!$this->id) return [];
        if(!is_null($limit) && is_numeric($limit)) $this->PDOBuild->limit((int)$limit, (int)$offset);
        $this->PDOBuild->where('t_tbl.section_id', (int)$this->id);
        $this->PDOBuild->select('t_tbl.*');
        /** @var Pmsreportsectioncolumns[] $_e */
        $_e = $this->PDOBuild->table('pms_report_section_columns', 't_tbl')->getAll('\Database\Monitoreorg\Pmsreportsectioncolumns');
        return $_e;
    }

    /**
     * @return int
     */
    function countPmsreportsectioncolumns(){
        if(!$this->id) return 0;
        $this->PDOBuild->where('t_tbl.section_id', (int)$this->id);
        return $this->PDOBuild->table('pms_report_section_columns','t_tbl')->count();
    }

}

/*
 * --------------------------DON'T REMOVE THIS------------------------- 
 * End of Class Pmsreportsections
 * DbObjectofier developed by angujo 
 * Tweet at @angujomondi 
 * Generated: 2017-01-27 03:20:10 UTC
 */

