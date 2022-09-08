<?php
class WalletDetails extends DatabaseObject
{

  static protected $table_name = "walletDetails";
  static protected $db_columns = ['id', 'customer_id', 'amount', 'refrence_no', 'description', 'created_by', 'bank_name', 'account_no', 'payment_id', 'approval', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $customer_id;
  public $amount;
  public $refrence_no;
  public $description;
  public $created_by;
  public $bank_name;
  public $account_no;
  public $payment_id;
  public $approval;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->amount = $args['amount'] ?? 0;
    $this->refrence_no = $args['refrence_no'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->bank_name = $args['bank_name'] ?? '';
    $this->account_no = $args['account_no'] ?? '';
    $this->payment_id = $args['payment_id'] ?? '';
    $this->approval = $args['approval'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

   

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->customer_id)) {
      $this->errors[] = "customer id can not be empty.";
    }
    
    return $this->errors;
  }

  static public function find_rec_by_customer_id($customer_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($customer_id) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  // static public function find_by_unapproved($options=[])
  // {
  //   $approval = $options['approval'] ?? false;
  //   $customer_id = $options['customer_id'] ?? false;

  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= "WHERE approval='" . self::$database->escape_string($approval) . "'";
  //   $sql .= " AND customer_id='" . self::$database->escape_string($customer_id) . "'";
  //   $obj_array = static::find_by_sql($sql);
  //   return $obj_array;
  // }

  static public function find_by_branch($city)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE city ='" . self::$database->escape_string($city) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
}
