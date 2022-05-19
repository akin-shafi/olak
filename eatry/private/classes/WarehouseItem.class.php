<?php
class WarehouseItem extends DatabaseObject {
  
  static protected $table_name = "warehouse_item";
   static protected $db_columns = ['id',  'item_name', 'ref_no', 'category', 'measurement', 'quantity', 'price', 'sold','created_by',  'created_at',  'updated_at',  'updated_by',  'deleted'];

   
   public $id;
   public $item_name;
   public $ref_no;
   public $category;
   public $measurement;
   public $quantity;
   public $price;
   public $sold;
   public $created_by;
   public $created_at;
   public $updated_at;
   public $updated_by;
   public $deleted;


  public $counts;


  public function __construct($args=[]) {
   $this->item_name     = $args['item_name'] ?? '';
   $this->ref_no        = $args['ref_no'] ?? '';
   $this->category        = $args['category'] ?? '';
   $this->quantity      = $args['quantity'] ?? '';
   $this->price      = $args['price'] ?? '';
   $this->measurement   = $args['measurement'] ?? '';
   $this->sold      = $args['sold'] ?? '';

   $this->created_by    = $args['created_by'] ?? '';
   $this->created_at    = $args['created_at'] ?? date('Y-m-d H:i:s');
   $this->updated_at    = $args['updated_at'] ?? '';
   $this->updated_by    = $args['updated_by'] ?? '';
   $this->deleted        = $args['deleted'] ?? '';

  }

 
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->item_name)) {
      $this->errors[] = "item name cannot be blank.";
    }elseif (!has_unique_item_name($this->item_name, $this->id ?? 0)) {
          $this->errors[] = "Item already exist. Try another.";
    }

    if(is_blank($this->measurement)) {
      $this->errors[] = "measurement cannot be blank.";
    }

   
    return $this->errors;
  }
 
  

  static public function find_by_item_name($item_name) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE item_name='" . self::$database->escape_string($item_name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  static public function find_by_ref_no($ref_no) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
   
  }

  static public function find_by_ref($ref_no) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
   
  }

  public static function find_by_category($category)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        
         $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }


  static public function clearQty($id) {
      $sql = "UPDATE " . static::$table_name . " SET ";
      $sql .= "quantity = 0 ";
      $sql .= " WHERE id='" . self::$database->escape_string($id) . "' ";
      $sql .= "LIMIT 1";
      // echo $sql;
      $result = self::$database->query($sql);
      return $result;
    }


  
  
}

?>
