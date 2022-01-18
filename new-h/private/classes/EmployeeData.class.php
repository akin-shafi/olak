<?php
class EmployeeData extends DatabaseObject
{
  protected static $table_name = "employee";
  protected static $db_columns = ['id', 'firstname', 'lastname', 'othername', 'department', 'location', 'phone', 'email', 'marital_status', 'dob', 'kin_name', 'kin_phone', 'highest_qualification', 'date_employed', 'bank_name', 'bank_account', 'professional_body', 'present_salary', 'grade_step', 'created_at', 'deleted'];

  public $id;
  public $firstname;
  public $lastname;
  public $othername;
  public $department;
  public $location;
  public $phone;
  public $email;
  public $marital_status;
  public $dob;
  public $kin_name;
  public $kin_phone;
  public $highest_qualification;
  public $date_employed;
  public $bank_name;
  public $bank_account;
  public $professional_body;
  public $present_salary;
  public $grade_step;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->firstname              = $args['firstname'] ?? '';
    $this->lastname               = $args['lastname'] ?? '';
    $this->othername              = $args['othername'] ?? '';
    $this->department             = $args['department'] ?? '';
    $this->location               = $args['location'] ?? '';
    $this->phone                  = $args['phone'] ?? '';
    $this->email                  = $args['email'] ?? '';
    $this->marital_status         = $args['marital_status'] ?? '';
    $this->dob                    = $args['dob'] ?? '';
    $this->kin_name               = $args['kin_name'] ?? '';
    $this->kin_phone              = $args['kin_phone'] ?? '';
    $this->highest_qualification  = $args['highest_qualification'] ?? '';
    $this->date_employed          = $args['date_employed'] ?? '';
    $this->bank_name              = $args['bank_name'] ?? '';
    $this->bank_account           = $args['bank_account'] ?? '';
    $this->professional_body      = $args['professional_body'] ?? '';
    $this->present_salary         = $args['present_salary'] ?? '';
    $this->grade_step             = $args['grade_step'] ?? '';
    $this->created_at             = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted                = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->firstname)) {
      $this->errors[] = "First name is required.";
    }

    if (is_blank($this->email)) {
      $this->errors[] = "Email is required.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    return $this->errors;
  }

  public function full_name()
  {
    return $this->firstname . " " . $this->lastname;
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
        $sql .= " OR firstname LIKE '%" . self::$database->escape_string($name) . "%'";
        $sql .= " OR lastname LIKE '%" . self::$database->escape_string($name) . "%'";
      }
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    }

    $sql .= "ORDER BY id DESC";
    return static::find_by_sql($sql);
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
