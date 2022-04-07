<?php

class Client extends DatabaseObject {

  static protected $table_name = "customer";
  static protected $db_columns = ['id', 'customer_id','first_name','last_name','phone','address','email', 'company_id', 'branch_id','created_by','created_at', 'deleted'];
  
  public $id;
  public $customer_id;
  public $first_name;
  public $last_name;
  public $address;
  public $phone;
  public $email;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $deleted;

  public function __construct($args=[]) {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->deleted = $args['deleted'] ?? NULL;
  }


  protected function validate() {
    $this->errors = [];

    // if(is_blank($this->customer_id)) {
    //   $this->errors[] = "customer ID is required.";
    // } 

    if(is_blank($this->first_name)) {
      $this->errors[] = "First Name is required.";
    } 

    if(is_blank($this->last_name)) {
      $this->errors[] = "Last Name is required.";
    } 

    if(is_blank($this->address)) {
      $this->errors[] = "Address is required";
    } 
    
    if(is_blank($this->phone)) {
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