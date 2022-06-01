<?php
class DraftDetails extends DatabaseObject
{
    protected static $table_name = "draft_details";
    protected static $db_columns = ['id', 'ref_no','product_id','product_name','quantity','product_price','total_price', 'deleted'];

    public $id;
    public $ref_no;
    public $product_id;
    public $product_name;
    public $quantity;
    public $product_price;
    public $total_price;
    public $deleted;
 
    public $counts;

    
    public function __construct($args=[])
    {   
        $this->ref_no = $args['ref_no'] ?? '';
        $this->product_id = $args['product_id'] ?? '';
        $this->product_name = $args['product_name'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
        $this->product_price = $args['product_price'] ?? '';
        $this->total_price = $args['total_price'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    public static function find_by_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
        // if (!empty($obj_array)) {
        //     return array_shift($obj_array);
        // } else {
        //     return false;
        // }
    }
    public static function find_ref($ref_no)
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
    public static function find_by_product_id($product_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE product_id='" . self::$database->escape_string($product_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function find_by_product($product_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE product_id='" . self::$database->escape_string($product_id) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
        
    }

    
}