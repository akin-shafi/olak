<?php

class Invoice extends DatabaseObject {

  static protected $table_name = 'invoice';
  static protected $db_columns = ['id', 'transid','service_type','quantity','unit_cost','amount','created_at', 'created_by','updated_at'];

  public $id;
  public $transid;
  public $service_type;
  public $quantity;
  public $unit_cost;
  // public $vat;
  public $amount;
  public $created_at;
  public $created_by;
  public $updated_at;



  public function __construct($args=[]) {

    $this->transid = $args['transid'] ?? '';
    $this->service_type = $args['service_type'] ?? '';
    $this->quantity = $args['quantity'] ?? ''; 
    $this->unit_cost = $args['unit_cost'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
    $this->created_by = $args['created_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? '';
    // $this->updatedTime = $args['updatedTime'] ?? date("Y-m-d H:i:s");

    // Caution: allows private/protected properties to be set
    // foreach($args as $k => $v) {
    //   if(property_exists($this, $k)) {
    //     $this->$k = $v;
    //   }
    // }
  }


  protected function validate() {
    $this->errors = [];
    
    if(is_blank($this->service_type)) {
      $this->errors[] = "Kindly Select a Service Type.";
    }
    // if(is_blank($this->vendor)) {
    //   $this->errors[] = "Kindly Select a Vendor.";
    // }
    // if(is_blank($this->request)) {
    //   $this->errors[] = "Kindly Select a Request.";
    // }
    if(is_blank($this->quantity)) {
      $this->errors[] = "Quantity cannot be blank.";
    }
    
    if(is_blank($this->unit_cost)) {
      $this->errors[] = "Unit-Cost cannot be blank.";
    }
    
    if(is_blank($this->amount)) {
      $this->errors[] = "Amount cannot be blank.";
    }

    return $this->errors;
  }

  static public function find_by_invoiceNum($invoiceNum) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE invoiceNum = ". self::$database->escape_string($invoiceNum). " " ;
    // echo $sql;
  return static::find_by_sql($sql);
  }

  static public function find_by_transid($transid) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE transid='" . self::$database->escape_string($transid) . "'";
    $obj_array = static::find_by_sql($sql);
    // if(!empty($obj_array)) {
    //   return array_shift($obj_array);
    // } else {
    //   return false;
    // }
    return static::find_by_sql($sql);
  }

  
 
  

}
