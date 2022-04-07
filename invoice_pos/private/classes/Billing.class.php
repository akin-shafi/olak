<?php

class Billing extends DatabaseObject {

  static protected $table_name = "billing";
  static protected $db_columns = [
   'id',
   'invoiceNum',
   'client_id',
   'billingFormat',
   'currency',
   'start_date',
   'due_date',
   'total_amount',
   'tax',
   'grand_total',
   'part_payment',
   'balance',
   
   'created_date',
   'updated_date',
   'deleted'
   
];
 
  public $id;
  public $invoiceNum;
  public $client_id;
  public $billingFormat;
  public $currency;
  public $start_date;
  public $due_date;
  public $total_amount;
  public $tax;
  public $grand_total;
  public $part_payment;
  public $balance;


  
  public $created_date;
  public $updated_date;
  public $deleted;

  

  const BILLING_FORMAT = [
      1 => 'Prepaid', 
      2 => 'Postpaid', 
      // 3 => 'Professionalism', 
      // 4 => 'Percentage', 
      // 5 => 'fixed fee', 
      // 6 => 'Appearance', 
      // 2 => 'Scaled'
  ];

 

  public function __construct($args=[]) {

    $this->invoiceNum = $args['invoiceNum'] ?? '';
    $this->client_id = $args['client_id'] ?? '';
    $this->billingFormat = $args['billingFormat'] ?? ''; 
    $this->currency = $args['currency'] ?? ''; 
    $this->start_date = $args['start_date'] ?? '';
    $this->due_date = $args['due_date'] ?? '';
    $this->total_amount = $args['total_amount'] ?? '';
    $this->tax = $args['tax'] ?? '';
    $this->grand_total = $args['grand_total'] ?? '';
    $this->part_payment = $args['part_payment'] ?? '';
    $this->balance = $args['balance'] ?? '';

  
    $this->created_date = $args['created_date'] ?? date('Y-m-d H:i:s');
    $this->updated_date = $args['updated_date'] ?? '';
    $this->deleted = $args['deleted'] ?? '';

  }

  protected function validate() {
    $this->errors = [];
    
    // if(is_blank($this->invoiceNum)) {
    //   $this->errors[] = "Invoice Number cannot be blank.";
    // } 
    // elseif (!has_unique_invoiceNum($this->invoiceNum, $this->id ?? 0)) {
    //   $this->errors[] = "invoiceNum generated already.";
    // }

    // if(is_blank($this->client_id)) {
    //   $this->errors[] = "Client name cannot be blank.";
    // }
    if(is_blank($this->billingFormat)) {
      $this->errors[] = "Billing Format is required.";
    }
    if(is_blank($this->currency)) {
      $this->errors[] = "currency is required.";
    }
    if(is_blank($this->start_date)) {
      $this->errors[] = "Application date cannot be blank.";
    }
    if(is_blank($this->due_date)) {
      $this->errors[] = "Due Date is required.";
    }
    // if(is_blank($this->amount)) {
    //   $this->errors[] = "Amount cannot be blank.";
    // }

    return $this->errors;
  }
  
  static public function find_by_invoice_no($invoiceNum) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE invoiceNum='" . self::$database->escape_string($invoiceNum) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
  static public function find_by_invoiceNum($invoiceNum) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE invoiceNum = ". self::$database->escape_string($invoiceNum). " " ;
    // echo $sql;
  return static::find_by_sql($sql);
  }

  static public function find_due_date(){
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE due_date <= CURRENT_DATE ";
    $sql .= "AND balance NOT IN(0 OR '') ";
    return static::find_by_sql($sql);

  }

  

}
