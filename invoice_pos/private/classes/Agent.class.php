<?php
class Agent extends DatabaseObject
{

  static protected $table_name = "agent";
  static protected $db_columns = ['id', 'agent_id', 'first_name', 'last_name', 'address', 'email', 'phone', 'bank_name', 'account_no', 'company_id', 'branch_id', 'created_by', 'created_at', 'deleted'];

  public $id;
  public $agent_id;
  public $first_name;
  public $last_name;
  public $address;
  public $email;
  public $phone;
  public $bank_name;
  public $account_no;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $deleted;

  const PAYMENT_METHOD = [
    1 => 'Wallet',
    2 => 'Credit',
  ];

  public function __construct($args = [])
  {
    $this->agent_id = $args['agent_id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->bank_name = $args['bank_name'] ?? '';
    $this->account_no = $args['account_no'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
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

    // if(is_blank($this->agent_id)) {
    //   $this->errors[] = "agent ID is required.";
    // } 

    if (is_blank($this->first_name)) {
      $this->errors[] = "First Name is required.";
    }

    if (is_blank($this->last_name)) {
      $this->errors[] = "Last Name is required.";
    }

    // if (is_blank($this->address)) {
    //   $this->errors[] = "Address is required";
    // }

    // if (is_blank($this->phone)) {
    //   $this->errors[] = "Phone Number is required";
    // } elseif (!has_unique_agent_phone($this->phone, $this->id ?? 0)) {
    //   $this->errors[] = "agent already exist, We found Phone Number in record.";
    // }

    return $this->errors;
  }



  public static function find_by_branch_id($bId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }

  static public function find_by_agent_id($agent_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE agent_id='" . self::$database->escape_string($agent_id) . "'";
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
