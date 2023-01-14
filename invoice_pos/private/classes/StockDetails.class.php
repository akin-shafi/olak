<?php
class StockDetails extends DatabaseObject
{
  protected static $table_name = "stock_details";
  protected static $db_columns = ['id','item_id','ref_no','initial_stock','supply',
  'unit_price',
  'total_amt','sold_stock','sold_stock_amt','qty_left','created_at','created_by', 'updated_at', 'updated_by', 'exception','deleted'];
     

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

        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? '';
        $this->updated_by = $args['updated_by'] ?? '';
        $this->exception = $args['exception'] ?? 0;
        $this->deleted = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->item_id)) {
            $this->errors[] = "item cannot be blank.";
        }
        if (is_blank($this->supply)) {
            $this->errors[] = "Quantity cannot be blank.";
        }
        // elseif($this->supply < 0){
        //   $this->errors[] = "Sorry you cannot enter negative value";
        // } 
        // if (is_blank($this->unit_price)) {
        //     $this->errors[] = "Price cannot be blank.";
        // } 
        // if (is_blank($this->per_unit_cost)) {
        //     $this->errors[] = "Per Unit cost cannot be blank.";
        // } 
    }

    public static function find_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        // $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    public static function find_by_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    public static function find_deleted_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= "AND (deleted = 1) ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
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
    

    public static function find_ref_no($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }


   static public function find_by_opened_at($opened_at) {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE  DATE(opened_at) = '" . self::$database->escape_string($opened_at) . "'";
      $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $obj_array = static::find_by_sql($sql);
      return $obj_array;
      
   }

    public static function find_by_items($options=[])
    {   
        $item = $options['item'] ?? false;
        $ref_no = $options['ref_no'] ?? false;
        

        $sql = "SELECT * FROM " . static::$table_name . " ";
        // $sql .= "WHERE item='" . self::$database->escape_string($item) . "'";
        $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      
        if($item){
          $sql .= " AND item  ='" . self::$database->escape_string($item) . "'";
        }
        if($ref_no){
          $sql .= " AND ref_no  ='" . self::$database->escape_string($ref_no) . "'";
        }

       
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function find_item($item_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";
        // $sql .= "AND (deleted = 1) ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

     public static function find_by_item_id($item_id)
    {   
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        return $obj_array; 
        
    }

    public static function find_by_deleted_item($options = [])
    {   
        
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $item_id = $options['item_id'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
        }
        $sql .= "AND (deleted = 1) ";
        $sql .= " ORDER BY id DESC ";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        return $obj_array; 
        
    }
    public static function find_by_item($item_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function find_by_date($options=[])
    {   
        $order = $options['order'] ?? '';
        $limit = $options['limit'] ?? '';
        $start = $options['start'] ?? '';
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $item_id = $options['item_id'] ?? false;
        
        $created_by = $options['created_by'] ?? false;
        

        // SELECT SUM(column_name)
        // FROM table_name
        // WHERE condition;
        $sql = "SELECT * FROM " . static::$table_name . " ";

       $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      
        if($created_by){
          $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
        }
        if($item_id){
          $sql .= " AND item_id  ='" . self::$database->escape_string($item_id) . "'";
        }

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
        }

        if ($order) {
          $sql .= " ORDER BY id " . self::$database->escape_string($order) . " ";
        }else{
          $sql .= " ORDER BY id DESC ";
        }

        if ($limit) {
          $sql .= "LIMIT ". self::$database->escape_string($limit) . " ";
        }
        
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
        // if (!empty($obj_array)) {
        //     return array_shift($obj_array);
        // } else {
        //     return false;
        // }
    }

   
    public static function sum_of_Stock($options=[])
    {
        $item_id = $options['item_id'] ?? false;
        $supply = $options['supply'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        
        $sql = "SELECT SUM(supply) FROM " . static::$table_name . " ";
        $sql .= " WHERE item_id  ='" . self::$database->escape_string($item_id) . "'";

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
        }

        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // echo $sql;
        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
    }
    
    public static function delete_yesterday_stockDetails(){
        $yesterday = date('Y-m-d');
        $stockBin = StockDetails::find_by_opened_at($yesterday);

        if (!empty($stockBin)) {
          foreach ($stockBin as $key => $value) {
            $id = $value->id;
            $deleteStock = StockDetails::find_by_id($id);
            $stockResult = $deleteStock->deleted($id);
            $stockResult = true;
          }
          if ($stockResult == true) {
            return true;
          }
          
        }else{
          return false;
        }
    }

    static public function return_to_zero($options=[]) {
      
      $id = $options['id'] ?? false;
      $closed_at = $options['closed_at'] ?? false;
      $closed_by = $options['closed_by'] ?? false;
      $sql = "UPDATE " . static::$table_name . " SET ";
      $sql .= "deleted = 1 ";
      
      if ($closed_at) {
          $sql .= ", updated_at='" . self::$database->escape_string($closed_at) . "' ";
      }
      if ($closed_by) {
          $sql .= ", updated_by='" . self::$database->escape_string($closed_by) . "' ";
      }
      $sql .= " WHERE id='" . self::$database->escape_string($id) . "' ";
      
      // $sql .= "LIMIT 1";
      // echo $sql;
      $result = self::$database->query($sql);
      return $result;
    }
}
