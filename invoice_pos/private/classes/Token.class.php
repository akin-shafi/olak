<?php

class Token extends DatabaseObject {

  static protected $table_name = "token";
  static protected $db_columns = ['id', 'token_id', 'token_type','customer_id', 'amount','status','created_by','created_at', 'deleted'];
  
  public $id;
  public $token_id;
  public $token_type;
  public $customer_id;
  public $amount;
  public $status;
  public $created_by;
  public $created_at;
  public $deleted;


  
  const TOKEN_TYPE = [
    1 => 'Refund Token',
    2 => 'Credit Token',
  ];

  const STATUS = [
    0 => 'Used',
    1 => 'Active',
  ];
  
  public function __construct($args=[]) {
    $this->token_id = $args['token_id'] ?? '';
    $this->token_type = $args['token_type'] ?? '';
    $this->customer_id = $args['customer_id'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->status = $args['status'] ?? 1;
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->deleted = $args['deleted'] ?? NULL;
  }


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->customer_id)) {
      $this->errors[] = "Customer name is required";
    }

    if(is_blank($this->token_type)) {
      $this->errors[] = "Token Type is required";
    } 

     if(is_blank($this->amount)) {
      $this->errors[] = "Account number is required";
    } 
    return $this->errors;
  }
 
  
  static public function find_by_customer_id($customer_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($customer_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_status($status)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE status='" . self::$database->escape_string($status) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }



  



}
