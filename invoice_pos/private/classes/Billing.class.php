<?php

class Billing extends DatabaseObject
{

  static protected $table_name = "billing";
  static protected $db_columns = [
    'id',
    'company_id',
    'branch_id',
    'status',
    'backlog',
    'waybill_no',
    'invoiceNum',
    'client_id',
    'billingFormat',
    'currency',
    'start_date',
    'due_date',
    'total_amount',
    'agent_id',
    'tax',
    'grand_total',
    'part_payment',
    'balance',
    'created_date',
    'created_by',
    'updated_date',
    'deleted'

  ];

  public $id;
  public $company_id;
  public $branch_id;
  public $status;
  public $backlog;
  public $waybill_no;
  public $invoiceNum;
  public $client_id;
  public $billingFormat;
  public $currency;
  public $start_date;
  public $due_date;
  public $total_amount;
  public $agent_id;
  public $tax;
  public $grand_total;
  public $part_payment;
  public $balance;
  public $created_date;
  public $created_by;
  public $updated_date;
  public $deleted;



  public $counts;

  const PAYMENT_METHOD = [
    // 1 => 'Wallet',
    2 => 'Cash',
    3 => 'Transfer',
    4 => 'POS',
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
    $this->backlog = $args['backlog'] ?? 0;
    $this->waybill_no = $args['waybill_no'] ?? '';
    $this->invoiceNum = $args['invoiceNum'] ?? '';
    $this->client_id = $args['client_id'] ?? '';
    $this->billingFormat = $args['billingFormat'] ?? '';
    $this->currency = $args['currency'] ?? '';
    $this->start_date = $args['start_date'] ?? '';
    $this->due_date = $args['due_date'] ?? '';
    $this->total_amount = $args['total_amount'] ?? '';
    $this->agent_id = $args['agent_id'] ?? '';
    $this->tax = $args['tax'] ?? '';
    $this->grand_total = $args['grand_total'] ?? '';
    $this->part_payment = $args['part_payment'] ?? '';
    $this->balance = $args['balance'] ?? '';
    $this->created_date = $args['created_date'] ?? date('Y-m-d H:i:s');
    $this->created_by = $args['created_by'] ?? '';
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
    return $this->errors;
  }

  // WHERE company_id = 1 AND branch_id = 2

  public static function find_by_filtering($options = []){

    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;
    $backlog = $options['backlog'] ?? false;
    $status = $options['status'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($company_id) {
         $sql .= " AND company_id='" . self::$database->escape_string($company_id) . "'";
    }

    if ($branch_id) {
       $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
    }
    if ($backlog || isset($backlog)) {
         $sql .= " AND backlog='" . self::$database->escape_string($backlog) . "'";
    }
    if ($status || isset($status)) {
         $sql .= " AND status='" . self::$database->escape_string($status) . "'";
    }
    // echo $sql;
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

  

  public static function sum_of_sales($options = [])
    {
      $status       = $options['status'] ?? false;
      $billingFormat = $options['billingFormat'] ?? false;
      $company_id = $options['company_id'] ?? false;
      $branch_id = $options['branch_id'] ?? false;

      $from = $options['from'] ?? false;
      $to   = $options['to'] ?? false;
      $sql = "SELECT SUM(grand_total) FROM " . static::$table_name . " ";
      $sql .= "WHERE status='" . self::$database->escape_string($status) . "'";
     
      if ($billingFormat) {
         $sql .= " AND billingFormat='" . self::$database->escape_string($billingFormat) . "'";
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
          $sql .= " AND DATE(created_date) = '" . self::$database->escape_string($from) . "' ";
        } elseif ($from > $to) {
          $sql .= " AND DATE(created_date) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
        } elseif ($from < $to) {
          $sql .= " AND DATE(created_date) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
        }
      } elseif ($from && !$to) {
        $sql .= " AND DATE(created_date) = '" . self::$database->escape_string($from) . "' ";
      } elseif (!$from && $to) {
        $sql .= " AND DATE(created_date) = '" . self::$database->escape_string($to) . "' ";
      }
      // echo $sql;
      $result_set = self::$database->query($sql);
      $row = $result_set->fetch_array();
      // pre_r( $row);
      return array_shift($row);
    }
    

  static public function find_by_metrics($options = [])
  {
    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;
    $sql = "SELECT COUNT(*) AS counts, SUM(total_amount) AS total_amount, SUM(grand_total) AS grand_total, SUM(part_payment) AS part_payment, SUM(balance) AS balance FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    if ($company_id) { $sql .= " AND company_id='" . self::$database->escape_string($company_id) . "'";}

    if ($branch_id) { $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'"; }
    // echo $sql;
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
