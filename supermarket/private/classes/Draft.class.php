<?php
class Draft extends DatabaseObject
{
    protected static $table_name = "draft";
    protected static $db_columns = ['id', 'ref_no','customer_id', 'store_id','total_item','created_by','created_at','processed_by','processed_at','deleted'];

    public $id;
    public $ref_no;
    public $customer_id;
    public $store_id;
    public $total_item;
    public $created_by;  
    public $created_at;
    public $processed_by;
    public $processed_at;
    public $deleted;
 
    public $counts;
    
    public function __construct($args=[])
    {   
        $this->ref_no = $args['ref_no'] ?? '';
        $this->customer_id = $args['customer_id'] ?? '';
        $this->store_id = $args['store_id'] ?? 1;
        $this->total_item = $args['total_item'] ?? 1;
        $this->created_by = $args['created_by'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->processed_by = $args['processed_by'] ?? '';
        $this->processed_at = $args['processed_at'] ?? date('Y-m-d H:i:s');
        
        $this->deleted = $args['deleted'] ?? '';
    }

    public static function find_by_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }



    
}