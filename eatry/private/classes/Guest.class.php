<?php
class Guest extends DatabaseObject {
  
  static protected $table_name = "guest";
  static protected $db_columns = ['id','title','address','state','city','zip','country','phone','email','gender', 'kin_name', 'kin_phone','guest_type', 'active', 'created_by', 'created_at',  'updated_by', 'updated_at',  'deleted'];


  public $id;
  public $title;
  // public $name;
  public $address;
  public $state;
  public $city;
  public $zip;
  public $country;
  public $phone;
  public $email;
  public $gender;

  public $kin_name;
  public $kin_phone;

  public $guest_type;
  public $active;

  public $created_by;
  public $created_at;
  public $update_by;
  public $update_at;
  
  public $deleted;

  public $counts;

  const GUEST_TYPE = [
    1 => 'Account Customer',
    2 => 'walkin Customer'
  ];
  const GENDER = [
    1 => 'male',
    2 => 'female',
    3 => 'others',
  ];
  const TITLE = [
    1 => 'Mr',
    2 => 'Mrs',
    3 => 'Miss',
    4 => 'Ms',
  ];

  public function __construct($args=[]) {
    $this->title = $args['title'] ?? '';
    // $this->name = $args['name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->state = $args['state'] ?? '';
    $this->city = $args['city'] ?? '';
    $this->zip = $args['zip'] ?? '';
    $this->country = $args['country'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->gender = $args['gender'] ?? '';

    $this->kin_name = $args['kin_name'] ?? '';
    $this->kin_phone = $args['kin_phone'] ?? '';

    $this->guest_type = $args['guest_type'] ?? '';
    $this->active = $args['active'] ?? 0;



    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_by = $args['updated_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }


  protected function validate() {
    $this->errors = [];

    // if (is_blank($this->name)) {
    //     $this->errors[] = "Guest name cannot be blank.";
    // }  

    // if (is_blank($this->phone)) {
    //     $this->errors[] = "Guest Phone cannot be blank.";
    // } 
    
    // if (is_blank($this->kin_name)) {
    //     $this->errors[] = "Guest Kin name cannot be blank.";
    // } 

    // if (is_blank($this->kin_phone)) {
    //     $this->errors[] = "Guest Kin Phone Number cannot be blank.";
    // } 

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    
    } 
    // elseif (!has_valid_email_format($this->email)) {
    //   $this->errors[] = "Email must be a valid format.";
    // }elseif (!has_unique_email_customer($this->email, $this->id ?? 0)) {
    //   $this->errors[] = "Email already exist. Try another.";
    // }

    if (is_blank($this->phone)) {
      $this->errors[] = "Phone Number cannot be blank.";
    } elseif (!has_length($this->phone, array('min' => 11, 'max' => 11))) {
      $this->errors[] = "Phone Number must be 11 Numbers.";
    }


    return $this->errors;
  }
 
  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  static public function find_by_customer_type($customer_type) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_type='" . self::$database->escape_string($customer_type) . "'";
    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
   
  }

  static public function find_by_undeleted($options=[]) {

    $limit = $options['limit'] ?? '';
    $clientcat = $options['clientcat'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($clientcat == 'account') {
      $sql .= " AND customer_type = '1' ";
    }elseif ($clientcat == 'walkin') {
      $sql .= " AND customer_type = '2' ";
    }
    
    if ($limit) {
      $sql .= " ORDER BY id DESC LIMIT " . self::$database->escape_string($limit) . "  ";
    }else{
      $sql .= " ORDER BY id DESC ";
    }

    return static::find_by_sql($sql);
  }
  static public function count_by_undeleted($options=[]) {

    $clientcat = $options['clientcat'] ?? false;

    $sql = "SELECT COUNT(*) FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($clientcat == 'account') {
      $sql .= " AND customer_type = '1' ";
    }elseif ($clientcat == 'walkin') {
      $sql .= " AND customer_type = '2' ";
    }

    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);

  }

  static public function find_by_branch($city) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE city ='" . self::$database->escape_string($city) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
  
}

?>
