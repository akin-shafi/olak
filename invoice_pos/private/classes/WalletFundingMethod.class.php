<?php
class WalletFundingMethod extends DatabaseObject
{

  static protected $table_name = "wallet_funding_method";
  static protected $db_columns = ['id', 'customer_id', 'payment_method', 'amount', 'payment_id', 'company_id', 'branch_id', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $customer_id;
  public $payment_method;
  public $amount;
  public $payment_id;
  public $company_id;
  public $branch_id;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->payment_method = $args['payment_method'] ?? '';
    $this->amount = $args['amount'] ?? 0;
    $this->payment_id = $args['payment_id'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
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
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_payment_method($payment_method)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE payment_method='" . self::$database->escape_string($payment_method) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
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
