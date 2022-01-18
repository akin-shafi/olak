<?php
class Employee extends DatabaseObject
{
  protected static $table_name = "employees";
  protected static $db_columns = ['id', 'company_id', 'employee_id', 'father_name', 'gender', 'hashed_password', 'present_add', 'permanent_add', 'blood_group', 'photo', 'notification', 'created_at', 'deleted'];

  public $id;
  public $company_id;
  public $employee_id;
  public $father_name;
  public $gender;
  public $hashed_password;
  public $present_add;
  public $permanent_add;
  public $blood_group;
  public $photo;
  public $notification;
  public $created_at;
  public $deleted;

  protected $password_required = true;
  public $password;
  public $confirm_password;

  public $counts;

  public function __construct($args = [])
  {
    $this->company_id       = $args['company_id'] ?? 1;
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->father_name      = $args['father_name'] ?? '';
    $this->gender           = $args['gender'] ?? '';
    $this->hashed_password  = $args['hashed_password'] ?? '';
    $this->present_add      = $args['present_add'] ?? '';
    $this->permanent_add    = $args['permanent_add'] ?? '';
    $this->blood_group      = $args['blood_group'] ?? '';
    $this->photo            = $args['photo'] ?? '';
    $this->notification     = $args['notification'] ?? '';
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
    } else {
      $this->password_required = false;
    }
    return parent::update();
  }

  protected function validate()
  {
    $this->errors = [];

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
