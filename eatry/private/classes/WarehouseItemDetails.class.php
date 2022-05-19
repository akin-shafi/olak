<?php
class WarehouseItemDetails extends DatabaseObject {
  
  static protected $table_name = "warehouse_item_details";
   static protected $db_columns = ['id','ref_no', 'item_id', 'supplier', 'supplier_contact','qty_supplied', 'unit_cost','total_cost', 'sold_stock','date_received','received_by','issued_to', 'unit_issued','issued_status', 'initial_stock', 'qty_left', 'value','created_at','updated_at','created_by','deleted'];



  public $id;
  public $ref_no;
  public $item_id;
  public $unit_cost;
  public $total_cost;
  public $supplier;
  public $supplier_contact;
  public $date_received;
  public $received_by;
  public $qty_supplied;

  public $initial_stock;
  public $sold_stock;
  public $qty_left;
  public $value;

  public $created_at ;
  public $updated_at ;
  public $created_by;
  public $deleted;

  public $counts;

  const SUPPLIER_TYPE = [
    1 => 'Sationaries',
    2 => 'Groceries'
  ];

  public function __construct($args=[]) {
    $this->ref_no = $args['ref_no'] ?? '';
    $this->item_id = $args['item_id'] ?? '';
    $this->unit_cost = $args['unit_cost'] ?? '';
    $this->total_cost = $args['total_cost'] ?? '';
    $this->supplier = $args['supplier'] ?? '';
    $this->supplier_contact = $args['supplier_contact'] ?? '';
    $this->date_received = $args['date_received'] ?? '';
    $this->received_by = $args['received_by'] ?? '';
    $this->qty_supplied = $args['qty_supplied'] ?? '';

    $this->issued_to = $args['issued_to'] ?? '';
    $this->unit_issued = $args['unit_issued'] ?? '';
    $this->issued_status = $args['issued_status'] ?? '';
    $this->initial_stock = $args['initial_stock'] ?? '';
    $this->sold_stock = $args['sold_stock'] ?? '';
    $this->qty_left = $args['qty_left'] ?? '';
    $this->value = $args['value'] ?? '';
 
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->created_by = $args['created_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? '';
    $this->updated_by = $args['updated_by'] ?? '';
    
    $this->deleted = $args['deleted'] ?? '';
  }

 
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->item_id)) {
      $this->errors[] = "item name cannot be blank.";
    } 

    if(is_blank($this->unit_cost)) {
      $this->errors[] = "cost of item cannot be blank.";
    } 
    
    if(is_blank($this->supplier)) {
      $this->errors[] = "supplier Name cannot be blank.";
    
    } 

    if(is_blank($this->date_received)) {
      $this->errors[] = "Date Received Name cannot be blank.";
    
    } 

   
    return $this->errors;
  }
 
  

  static public function find_by_supplier($supplier) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE supplier='" . self::$database->escape_string($supplier) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  public static function find_by_item_id($item_id)
    {   
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
        // if (!empty($obj_array)) {
        //     return array_shift($obj_array);
        // } else {
        //     return false;
        // }
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
  static public function find_by_supplier_type($supplier_type) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE supplier_type='" . self::$database->escape_string($supplier_type) . "'";
    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
   
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



  
  
}

?>
