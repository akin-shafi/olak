<?php
class Client extends DatabaseObject
{

  static protected $table_name = "customer";
  static protected $db_columns = ['id', 'customer_id', 'first_name', 'last_name', 'phone', 'address', 'email', 'credit_facility', 'company_id', 'branch_id', 'balance', 'deposit', 'payment_id','created_by', 'created_at', 'deleted'];

  public $id;
  public $customer_id;
  public $first_name;
  public $last_name;
  public $address;
  public $phone;
  public $email;
  public $credit_facility;
  public $company_id;
  public $branch_id;
  public $balance;
  public $deposit;
  public $payment_id;
  public $created_by;
  public $created_at;
  public $deleted;

  const PAYMENT_METHOD = [
    1 => 'Wallet',
    2 => 'Credit',
  ];

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->credit_facility = $args['credit_facility'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';

    $this->balance = $args['balance'] ?? '';
    $this->deposit = $args['deposit'] ?? '';
    $this->payment_id = $args['payment_id'] ?? '';


    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->deleted = $args['deleted'] ?? NULL;
  }


  public function full_name()
  {
    return $this->first_name . " " . $this->last_name;
  }

  protected function validate()
  {
    $this->errors = [];

    // if(is_blank($this->customer_id)) {
    //   $this->errors[] = "customer ID is required.";
    // } 

    if (is_blank($this->first_name)) {
      $this->errors[] = "First Name is required.";
    }

    if (is_blank($this->last_name)) {
      $this->errors[] = "Last Name is required.";
    }

    if (is_blank($this->address)) {
      $this->errors[] = "Address is required";
    }

    if (is_blank($this->phone)) {
      $this->errors[] = "Phone Number is required";
    } elseif (!has_unique_client_phone($this->phone, $this->id ?? 0)) {
      $this->errors[] = "Customer already exist, We found Phone Number in record.";
    }

    // if(is_blank($this->email)) {
    //   $this->errors[] = "Email cannot be blank.";
    // } elseif (!has_length($this->email, array('max' => 255))) {
    //   $this->errors[] = "Email must be less than 255 characters.";
    // } elseif (!has_valid_email_format($this->email)) {
    //   $this->errors[] = "Email must be a valid format.";
    // } elseif (!has_unique_client_email($this->email, $this->id ?? 0)) {
    //   $this->errors[] = "The email you entered is already taken. Try another.";
    // }


    return $this->errors;
  }


  public static function find_by_company($options=[]) 
  {
      $company_id = $options['company_id'] ?? false;
      $branch_id = $options['branch_id'] ?? false;
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE company_id='" . self::$database->escape_string($company_id) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
   
      $sql .= " ORDER BY id ASC ";
      // echo $sql;

      $obj_array = static::find_by_sql($sql);
      return $obj_array;
  }

  public static function find_by_branch_id($bId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
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

  static public function find_by_phone($phone)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE phone='" . self::$database->escape_string($phone) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
