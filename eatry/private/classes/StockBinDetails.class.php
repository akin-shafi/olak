<?php
class StockBinDetails extends StockDetails
{
    // KitchenRegisterDetails
  protected static $table_name = "stock_bin_details";
  protected static $db_columns = ['id','item_id','ref_no','initial_stock','supply',
  'unit_price',
  'total_amt','sold_stock','sold_stock_amt','qty_left', 'value_of_qty_left','created_at','created_by', 'updated_at', 'updated_by', 'exception','deleted'];
     

    public $id;    
    public $item_id;    
    public $ref_no;  
    public $initial_stock;  
    public $supply; 
    public $unit_price;  
    public $total_amt; 
   
    public $sold_stock;  
    public $sold_stock_amt;
    public $qty_left;
    public $value_of_qty_left;

    public $created_at;
    public $created_by;
    public $updated_at;
    public $updated_by;
    public $exception;
    public $deleted;

     
 
    public $counts;

    public function __construct($args=[])
    {

        $this->item_id = $args['item_id'] ?? '';    
        $this->ref_no = $args['ref_no'] ?? '';    
        $this->initial_stock = $args['initial_stock'] ?? '';    
        $this->supply = $args['supply'] ?? ''; 
        $this->unit_price = $args['unit_price'] ?? '';  
        $this->total_amt = $args['total_amt'] ?? ''; 
        $this->sold_stock = $args['sold_stock'] ?? 0;  
        $this->sold_stock_amt = $args['sold_stock_amt'] ?? 0;
        $this->qty_left = $args['qty_left'] ?? '';
        $this->value_of_qty_left = $args['value_of_qty_left'] ?? '';

        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? '';
        $this->updated_by = $args['updated_by'] ?? '';
        $this->exception = $args['exception'] ?? 0;
        $this->deleted = $args['deleted'] ?? '';
    }

    public static function find_recordby_date($options=[])
    {
        $ref_no = $options['ref_no'] ?? false;
        $date = $options['date'] ?? false;

        $sql = "SELECT * FROM " . static::$table_name . " ";
        
        $sql .= "WHERE (deleted = 1) ";

        if ($ref_no) {
            $sql .= "AND  ref_no='" . self::$database->escape_string($ref_no) . "'";
        }

        if ($date) {
            // $sql .= "AND  created_at='" . self::$database->escape_string($date) . "'";
            $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($date) . "' ";
        }
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    

    public static function find_ref($ref_no)
    {
        $sql = "SELECT DISTINCT `item_id` FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        echo $sql;

        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
   
    
}
