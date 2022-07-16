<?php
class Admin extends DatabaseObject
{

  static protected $table_name = "admins";
  static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'phone', 'hashed_password', 'admin_level', 'company_id', 'branch_id', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $first_name;
  public $last_name;
  public $email;
  public $phone;
  public $admin_level;
  public $company_id;
  public $branch_id;


  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;

  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;
  public $counts;

  const ADMIN_LEVEL = [
    1 => 'Super Admin',
    2 => 'Admin',
    3 => 'Sales Manager',
    4 => 'Sales Rep',
    5 => 'Account',
  ];


  public function __construct($args = [])
  {
    $this->first_name = $args['first_name'] ??  '';
    $this->last_name  = $args['last_name']  ??  '';
    $this->email  = $args['email']  ??  '';
    $this->phone  = $args['phone']  ??  '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
    // $this->hashed_password  = $args['hashed_password']  ??  '';
    $this->admin_level  = $args['admin_level']  ??  '';
    $this->company_id  = $args['company_id']  ??  '';
    $this->branch_id  = $args['branch_id']  ??  '';
    $this->created_by = $args['created_by'] ??  '';
    $this->created_at = $args['created_at'] ??  date('Y-m-d H:i:s');
    $this->updated_at  = $args['updated_at']  ??  date('Y-m-d H:i:s');
    $this->deleted  = $args['deleted']  ??  NULL;
  }

  protected function set_hashed_password()
  {
    $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password)
  {
    return password_verify($password, $this->hashed_password);
  }

  protected function create()
  {
    $this->set_hashed_password();
    return parent::create();
  }

  protected function update()
  {
    if ($this->password != '') {
      $this->set_hashed_password();
      // validate password
    } else {
      // password not being updated, skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->first_name)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if (is_blank($this->last_name)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    // if (is_blank($this->state)) {
    //   $this->errors[] = "Kindly Select a state.";
    // }

    if (is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->errors[] = "Email not allowed. Try another.";
    }

    if (is_blank($this->company_id)) {
      $this->errors[] = "Company name cannot be blank.";
    }

    if (is_blank($this->branch_id)) {
      $this->errors[] = "Branch name cannot be blank.";
    }
    // if (is_blank($this->username)) {
    //   $this->errors[] = "Username cannot be blank.";
    // } elseif (!has_length($this->username, array('min' => 3, 'max' => 255))) {
    //   $this->errors[] = "Username must be between 3 and 255 characters.";
    // } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
    //   $this->errors[] = "Username not allowed. Try another.";
    // }

    // if ($this->password_required) {
    //   if (is_blank($this->password)) {
    //     $this->errors[] = "Password cannot be blank.";
    //   } elseif (!has_length($this->password, array('min' => 8))) {
    //     $this->errors[] = "Password must contain 8 or more characters";
    //   } elseif (!preg_match('/[A-Z]/', $this->password)) {
    //     $this->errors[] = "Password must contain at least 1 uppercase letter";
    //   } elseif (!preg_match('/[a-z]/', $this->password)) {
    //     $this->errors[] = "Password must contain at least 1 lowercase letter";
    //   } elseif (!preg_match('/[0-9]/', $this->password)) {
    //     $this->errors[] = "Password must contain at least 1 number";
    //   } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
    //     $this->errors[] = "Password must contain at least 1 symbol";
    //   }

    //   if (is_blank($this->confirm_password)) {
    //     $this->errors[] = "Confirm password cannot be blank.";
    //   } elseif ($this->password !== $this->confirm_password) {
    //     $this->errors[] = "Password and confirm password must match.";
    //   }
    // }

    return $this->errors;
  }

  static public function find_by_username($username)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_email($email)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_branch_id($bId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }

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
