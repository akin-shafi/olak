<?php

class Billing extends DatabaseObject
{

  static protected $table_name = "billing";
  static protected $db_columns = [
    'id',
    'company_id',
    'branch_id',
    'status',
    'waybill_no',
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
  public $company_id;
  public $branch_id;
  public $status;
  public $waybill_no;
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



  public $counts;

  const PAYMENT_METHOD = [
    1 => 'Wallet',
    2 => 'Cash',
  ];

  const BILLING_FORMAT = [
    1 => 'Prepaid',
    2 => 'Postpaid',
  ];

  const STATUS = [
    1 => 'In Progress',
    2 => 'Delivered',
  ];



  public function __construct($args = [])
  {
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->status = $args['status'] ?? 1;
    $this->waybill_no = $args['waybill_no'] ?? 1;
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

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->billingFormat)) {
      $this->errors[] = "Billing Format is required.";
    }
    if (is_blank($this->currency)) {
      $this->errors[] = "currency is required.";
    }
    // if (is_blank($this->start_date)) {
    //   $this->errors[] = "Application date cannot be blank.";
    // }
    // if (is_blank($this->due_date)) {
    //   $this->errors[] = "Due Date is required.";
    // }
    // if(is_blank($this->amount)) {
    //   $this->errors[] = "Amount cannot be blank.";
    // }

    return $this->errors;
  }

  // WHERE company_id = 1 AND branch_id = 2

  static public function find_by_filtering($company_id, $branch_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE company_id = " . self::$database->escape_string($company_id) . " ";
    $sql .= "AND branch_id = " . self::$database->escape_string($branch_id) . " ";
    return static::find_by_sql($sql);
  }

  static public function find_by_invoice_no($invoiceNum)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE invoiceNum='" . self::$database->escape_string($invoiceNum) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_metrics()
  {
    $sql = "SELECT COUNT(*) AS counts, SUM(total_amount) AS total_amount, SUM(grand_total) AS grand_total, SUM(part_payment) AS part_payment, SUM(balance) AS balance FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_invoiceNum($invoiceNum)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE invoiceNum = " . self::$database->escape_string($invoiceNum) . " ";
    return static::find_by_sql($sql);
  }

  static public function find_due_date()
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE due_date <= CURRENT_DATE ";
    $sql .= "AND balance NOT IN(0 OR '') ";
    return static::find_by_sql($sql);
  }
}
