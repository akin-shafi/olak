<?php
class WalletFundingMethod extends DatabaseObject
{

  static protected $table_name = "wallet_funding_method";
  static protected $db_columns = ['id', 'customer_id', 'payment_method', 'amount', 'bank_name','payment_id', 'refrence_no', 'description', 'company_id', 'branch_id', 'approval', 'created_at', 'created_by', 'updated_at', 'deleted'];

  public $id;
  public $customer_id;
  public $payment_method;
  public $amount;
  public $bank_name;
  public $payment_id;
  public $refrence_no;
  public $description;
  public $company_id;
  public $branch_id;
  public $approval;
  public $created_at;
  public $created_by;
  public $updated_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->payment_method = $args['payment_method'] ?? '';
    $this->amount = $args['amount'] ?? 0;
    $this->bank_name = $args['bank_name'] ?? 0;
    $this->payment_id = $args['payment_id'] ?? '';
    $this->refrence_no = $args['refrence_no'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->approval = $args['approval'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
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
    // $obj_array = static::find_by_sql($sql);
    // if (!empty($obj_array)) {
    //   return array_shift($obj_array);
    // } else {
    //   return false;
    // }

    $obj_array = static::find_by_sql($sql);
    return $obj_array;
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

  static public function find_by_refrence_no($refrence_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE refrence_no='" . self::$database->escape_string($refrence_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function sum_of_unapproved($options = [])
  {
    $approval       = $options['approval'] ?? false;
    $customer_id    = $options['customer_id'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;

    $from = $options['from'] ?? false;
    $to   = $options['to'] ?? false;
    $sql = "SELECT SUM(amount) FROM " . static::$table_name . " ";
    $sql .= "WHERE approval='" . self::$database->escape_string($approval) . "'";
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
    $approval = $options['approval'] ?? false;
    $customer_id = $options['customer_id'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE approval='" . self::$database->escape_string($approval) . "'";
    if ($customer_id) {
      $sql .= " AND customer_id='" . self::$database->escape_string($customer_id) . "'";
    }
    
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
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
