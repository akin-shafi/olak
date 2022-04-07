<?php
class Users extends DatabaseObject {
 
  static protected $table_name = "users";
  static protected $db_columns = ['id', 'full_name', 'username', 'email', 'password', 'user_type', 'register_date', 'profile_img', 'deleted'];

  public $id;
  public $full_name;
  public $username;
  public $email;
  public $user_type;
  public $register_date;
  public $profile_img;
  public $deleted;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;
  
  const TYPE = [
    1 => 'Admin',
    2 => 'Others',    
  ];

  public function __construct($args=[]) {
    $this->full_name = $args['full_name'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->user_type = $args['user_type'] ?? '';
    $this->register_date = $args['register_date'] ?? date('Y-m-d H:i:s');
    $this->profile_img = $args['profile_img'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  public function full_name() {
    return $this->full_name;
  }


  protected function set_hashed_password() {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hashed_password);
  }

  protected function create() {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate() {
    $this->errors = [];

    // if(is_blank($this->last_name)) {
    //   $this->errors[] = "Last name cannot be blank.";
    // } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
    //   $this->errors[] = "Last name must be between 2 and 255 characters.";
    // }
    
    if(is_blank($this->full_name)) {
       $this->errors[] = "Your name is required.";
    } 

    //   if(is_blank($this->user_type)) {
    //     $this->errors[] = "Kindly Select a User Type.";
    //  } 

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->errors[] = "The email you entered is already taken. Try another.";
    }

    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 3, 'max' => 16))) {
      $this->errors[] = "Username must be between 3 and 16 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "The username you entered is already taken. Try another.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 8))) {
        $this->errors[] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
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
