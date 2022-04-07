<?php
class InvoiceDetails extends DatabaseObject {
 
  static protected $table_name = "invoice_details";
  static protected $db_columns = ['id', 'invoice_id', 'product_id', 'price', 'quantity'];

  public $id;
  public $invoice_id;
  public $product_id;
  public $price;
  public $quantity;

  public function __construct($args=[]) {
    
    $this->invoice_id = $args['invoice_id'] ?? '';
    $this->product_id = $args['product_id'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->quantity = $args['quantity'] ?? '';
  }

  protected function validate() {
    $this->errors = [];
     
    // if(is_blank($this->quantity)) {
    //   $this->errors[] = "Tax cannot be blank.";
    // }

    return $this->errors;
  }
 
  // static public function find_by_username($username) {
  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
  //   $obj_array = static::find_by_sql($sql);
  //   if(!empty($obj_array)) {
  //     return array_shift($obj_array);
  //   } else {
  //     return false;
  //   }
  // }
  


  
}

?>
