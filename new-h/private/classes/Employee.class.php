<?php
class Employee extends DatabaseObject
{
  protected static $table_name = "employees";
  protected static $db_columns = ['id', 'company_id', 'employee_id', 'department_id', 'designation_id', 'first_name', 'last_name', 'gender', 'phone', 'email', 'hashed_password', 'address', 'country', 'state', 'dob', 'marital_status', 'children', 'religion', 'photo', 'employment_type', 'location', 'date_employed', 'created_at', 'deleted'];

  public $id;
  public $company_id;
  public $employee_id;
  public $department_id;
  public $designation_id;
  public $first_name;
  public $last_name;
  public $gender;
  public $phone;
  public $email;
  public $address;
  public $country;
  public $state;
  public $dob;
  public $marital_status;
  public $children;
  public $religion;
  public $photo;
  public $employment_type;
  public $location;
  public $date_employed;
  public $created_at;
  public $deleted;

  protected $password_required = true;
  public $hashed_password;
  public $password;
  public $confirm_password;

  public $counts;

  public function __construct($args = [])
  {
    $this->company_id      = $args['company_id'] ?? 1;
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->department_id    = $args['department_id'] ?? '';
    $this->designation_id   = $args['designation_id'] ?? '';
    $this->first_name       = $args['first_name'] ?? '';
    $this->last_name        = $args['last_name'] ?? '';
    $this->gender           = $args['gender'] ?? '';
    $this->phone            = $args['phone'] ?? '';
    $this->email            = $args['email'] ?? '';
    $this->address          = $args['address'] ?? '';
    $this->country          = $args['country'] ?? '';
    $this->state            = $args['state'] ?? '';
    $this->dob              = $args['dob'] ?? '';
    $this->marital_status   = $args['marital_status'] ?? '';
    $this->children         = $args['children'] ?? '';
    $this->religion         = $args['religion'] ?? '';
    $this->photo            = $args['photo'] ?? '';
    $this->employment_type  = $args['employment_type'] ?? '';
    $this->location         = $args['location'] ?? '';
    $this->date_employed    = $args['date_employed'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
    $this->password         = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
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
      $this->errors[] = "First name is required.";
    }

    if (is_blank($this->email)) {
      $this->errors[] = "Email is required.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if ($this->password_required) {
      if (is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      }
      if (is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }

  public function full_name()
  {
    return $this->first_name . " " . $this->last_name;
  }


  public static function find_by_employee_id($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_query($options = [])
  {
    $id = $options['employee_id'] ?? false;
    $name = $options['name'] ?? false;
    $designate = $options['designate'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";

    if (isset($id) || isset($name) || isset($designate)) {
      $sql .= "WHERE employee_id='" . self::$database->escape_string($id) . "'";
      if (!empty($designate)) {
        $sql .= " OR designation_id='" . self::$database->escape_string($designate) . "'";
      }
      if (!empty($name)) {
        $sql .= " OR first_name LIKE '%" . self::$database->escape_string($name) . "%'";
        $sql .= " OR last_name LIKE '%" . self::$database->escape_string($name) . "%'";
      }
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    }

    $sql .= "ORDER BY id DESC";
    return static::find_by_sql($sql);
  }

  public static function find_by_company_id($company_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE company_id='" . self::$database->escape_string($company_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  public static function find_by_gender($gender)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE gender='" . self::$database->escape_string($gender) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }
}
