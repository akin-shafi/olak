<?php

class Refund extends DatabaseObject {

  static protected $table_name = "refund";
  static protected $db_columns = ['id', 'customer_id', 'amount', 'bank_name', 'bank_account','status','created_by','created_at', 'deleted'];
  
  public $id;
  public $customer_id;
  public $amount;
  public $bank_name;
  public $bank_account;
  public $status;
  public $created_by;
  public $created_at;
  public $deleted;


  const STATUS = [
    0 => 'unapproved',
    1 => 'Approved',
  ];
  
  public function __construct($args=[]) {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->bank_name = $args['bank_name'] ?? '';
    $this->bank_account = $args['bank_account'] ?? '';
    $this->status = $args['status'] ?? 0;
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->deleted = $args['deleted'] ?? NULL;
  }


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->customer_id)) {
      $this->errors[] = "Customer name is required";
    }

    if(is_blank($this->bank_account)) {
      $this->errors[] = "Bank Account is required";
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

   public static function sum_of_unapproved($options = [])
  {
    $status       = $options['status'] ?? false;
    $customer_id    = $options['customer_id'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;

    $from = $options['from'] ?? false;
    $to   = $options['to'] ?? false;
    $sql = "SELECT SUM(amount) FROM " . static::$table_name . " ";
    $sql .= "WHERE status='" . self::$database->escape_string($status) . "'";
    if ($customer_id) {
       $sql .= " AND customer_id='" . self::$database->escape_string($customer_id) . "'";
    }
    if ($payment_method) {
       $sql .= " AND payment_method='" . self::$database->escape_string($payment_method) . "'";
    }
    if ($company_id) {
       $sql .= " AND company_id='" . self::$database->escape_string($company_id) . "'";
    }

    if ($branch_id) {
       $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
    }
    $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

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
    // echo $sql;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    // pre_r( $row);
    return array_shift($row);
  }

 
 static public function find_by_unapproved($options=[])
  {
    $status = $options['status'] ?? false;
    $customer_id = $options['customer_id'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE status='" . self::$database->escape_string($status) . "'";
    if ($customer_id) {
      $sql .= " AND customer_id='" . self::$database->escape_string($customer_id) . "'";
    }
    $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }
  
  static public function find_duplicate($options=[]){
    $customer_id    = $options['customer_id'] ?? false;
    $amount        = $options['amount'] ?? false;
    $created_by     = $options['created_by'] ?? false;
    $created_at     = $options['created_at'] ?? false;
    
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE amount='" . self::$database->escape_string($amount) . "'";

    if ($customer_id) {
         $sql .= " AND customer_id='" . self::$database->escape_string($customer_id) . "'";
    }

    if ($created_by) {
      $sql .= " AND created_by='" . self::$database->escape_string($created_by) . "'";
    }

    if ($created_at) {
      $sql .= " AND created_at = '" . self::$database->escape_string($created_at) . "' ";
    }

    // echo $sql;
    return static::find_by_sql($sql);
  }
  



  



}
