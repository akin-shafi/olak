<?php
class Wallet extends DatabaseObject
{

  static protected $table_name = "wallet";
  static protected $db_columns = ['id', 'customer_id', 'balance', 'deposit','payment_id', 'company_id', 'branch_id',  'created_at', 'created_by', 'narration','deleted'];

  public $id;
  public $customer_id;
  public $balance;
  public $deposit;
  public $payment_id;
  public $company_id;
  public $branch_id;
  public $created_at;
  public $created_by;
  public $narration;
  public $deleted;

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->balance = $args['balance'] ?? '';
    $this->deposit = $args['deposit'] ?? 0;
    $this->payment_id = $args['payment_id'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->narration = $args['narration'] ?? '';
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    // if (is_blank($this->payment_method)) {
    //   $this->errors[] = "customer id can not be empty.";
    // }

    return $this->errors;
  }

  static public function find_by_customer_id($customer_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($customer_id) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  static public function find_by_payment_id($payment_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE payment_id='" . self::$database->escape_string($payment_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  static public function find_duplicate($options=[]){
    $customer_id    = $options['customer_id'] ?? false;
    $deposit        = $options['deposit'] ?? false;
    $created_by     = $options['created_by'] ?? false;
    $created_at     = $options['created_at'] ?? false;
    
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE deposit='" . self::$database->escape_string($deposit) . "'";

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
  static public function find_by_branch_id($branch_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE branch_id ='" . self::$database->escape_string($branch_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
}
