<?php
class Warehouse extends DatabaseObject {
  
  static protected $table_name = "warehouse";
   static protected $db_columns = ['id','item', 'purchase_price','supplier','supplied_on','quantity','issued_to','issued_status','created_at','updated_at','created_by','deleted'];



  public $id;
  public $item; 
  public $purchase_price;
  public $supplier;
  public $supplied_on;
  public $quantity;
  public $issued_to;
  public $issued_status;
  // public $confirm_issued_status;
  // protected $issued_status_required = true;

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
    $this->item = $args['item'] ?? '';
    $this->purchase_price = $args['purchase_price'] ?? '';
    $this->supplier = $args['supplier'] ?? '';
    $this->supplied_on = $args['supplied_on'] ?? '';
    $this->quantity = $args['quantity'] ?? '';
    $this->issued_to = $args['issued_to'] ?? '';

    $this->issued_status = $args['issued_status'] ?? '';
 
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->created_by = $args['created_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? '';
    $this->updated_by = $args['updated_by'] ?? '';
    
    $this->deleted = $args['deleted'] ?? '';
  }

 
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->item)) {
      $this->errors[] = "item name cannot be blank.";
    } 
    // elseif (!has_length($this->item, array('min' => 2, 'max' => 255))) {
    //   $this->errors[] = "Company name must be between 2 and 255 characters.";
    // }

    if(is_blank($this->purchase_price)) {
      $this->errors[] = "purchase_price issued_to cannot be blank.";
    } 
    

    if(is_blank($this->supplier)) {
      $this->errors[] = "supplier cannot be blank.";
    
    } 

    if (is_blank($this->issued_to)) {
      $this->errors[] = "Person's iSsued to cannot be blank.";
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
  static public function find_by_supplier_type($supplier_type) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE supplier_type='" . self::$database->escape_string($supplier_type) . "'";
    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
   
  }



  
  
}

?>
