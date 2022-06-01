<?php
class LedgerTracker extends DatabaseObject
{
    // KitchenRegisterDetails
  protected static $table_name = "ledger_tracker";
  protected static $db_columns = ['id','pushed_at','status'];
     

    public $id;
    public $pushed_at;
    public $status;

 
    public $counts;

    public function __construct($args=[])
    {
        $this->pushed_at = $args['pushed_at'] ?? '';
        $this->status = $args['status'] ?? '';
        
    }


      public static function find_date_created($date)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE DATE(pushed_at) = '" . self::$database->escape_string($date) . "' ";
           
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }   

    
    
}
