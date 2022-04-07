<?php
class Invoice extends DatabaseObject {
 
  static protected $table_name = "invoices";
  static protected $db_columns = ['id', 'customer_id', 'order_date', 'sub_total', 'vat', 'discount', 'net_total', 'paid', 'due', 'payment_type','created_at','updated_at','deleted'];

  public $id;
  public $customer_id;
  public $order_date;
  public $sub_total;
  public $gst;
  public $discount;
  public $net_total;
  public $paid;
  public $due;
  public $payment_type;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args=[]) {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->order_date = $args['order_date'] ?? date('Y-m-d');
    $this->sub_total = $args['sub_total'] ?? '';
    $this->gst = $args['gst'] ?? '';
    $this->discount = $args['discount'] ?? '';
    $this->net_total = $args['net_total'] ?? '';
    $this->paid = $args['paid'] ?? '';
    $this->due = $args['due'] ?? '';
    $this->payment_type = $args['payment_type'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->customer_id)) {
      $this->errors[] = "Customer Name cannot be blank.";
    } 

    if(is_blank($this->order_date)) {
      $this->errors[] = "Date of order cannot be blank.";
    } 

    if(is_blank($this->sub_total)) {
      $this->errors[] = "Product name cannot be blank.";
    } 
     
    if(is_blank($this->gst)) {
      $this->errors[] = "Tax cannot be blank.";
    }

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
