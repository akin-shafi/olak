<?php
class Employee extends DatabaseObject
{
  protected static $table_name = "employees";
  protected static $db_columns = ['id', 'employee_id', 'first_name', 'last_name', 'other_name', 'phone', 'email', 'gender', 'marital_status', 'dob', 'kin_name', 'kin_phone', 'present_add', 'permanent_add', 'highest_qualification', 'company', 'branch', 'department', 'job_title', 'date_employed', 'employment_type', 'present_salary', 'grade_step', 'bank_name', 'account_number', 'blood_group', 'company_id', 'photo', 'notification', 'hashed_password', 'update_profile', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $first_name;
  public $last_name;
  public $other_name;
  public $phone;
  public $email;
  public $gender;
  public $marital_status;
  public $dob;
  public $kin_name;
  public $kin_phone;
  public $present_add;
  public $permanent_add;
  public $highest_qualification;
  public $company;
  public $branch;
  public $department;
  public $job_title;
  public $date_employed;
  public $employment_type;
  public $present_salary;
  public $grade_step;
  public $bank_name;
  public $account_number;
  public $blood_group;
  public $company_id;
  public $photo;
  public $notification;
  public $update_profile;
  public $created_at;
  public $deleted;

  public $total_salary;
  public $counts;

  protected $password_required = true;
  public $password;
  public $hashed_password;
  public $confirm_password;

  const TEXT_COLOR = [
    0 => 'text-purple',
    1 => 'text-primary',
    2 => 'text-secondary',
    3 => 'text-success',
    4 => 'text-danger',
    5 => 'text-warning',
    6 => 'text-info',
    7 => 'text-dark',
  ];

  const BG_COLOR = [
    0 => 'bg-purple',
    1 => 'bg-primary',
    2 => 'bg-secondary',
    3 => 'bg-success',
    4 => 'bg-danger',
    5 => 'bg-warning',
    6 => 'bg-info',
    7 => 'bg-dark',
  ];

  public function __construct($args = [])
  {
    $this->employee_id            = $args['employee_id'] ?? '';
    $this->first_name             = $args['first_name'] ?? '';
    $this->last_name              = $args['last_name'] ?? '';
    $this->other_name             = $args['other_name'] ?? '';
    $this->phone                  = $args['phone'] ?? '';
    $this->email                  = $args['email'] ?? '';
    $this->gender                 = $args['gender'] ?? '';
    $this->marital_status         = $args['marital_status'] ?? '';
    $this->dob                    = $args['dob'] ?? '';
    $this->kin_name               = $args['kin_name'] ?? '';
    $this->kin_phone              = $args['kin_phone'] ?? '';
    $this->present_add            = $args['present_add'] ?? '';
    $this->permanent_add          = $args['permanent_add'] ?? '';
    $this->highest_qualification  = $args['highest_qualification'] ?? '';
    $this->company                = $args['company'] ?? '';
    $this->branch                 = $args['branch'] ?? '';
    $this->department             = $args['department'] ?? '';
    $this->job_title              = $args['job_title'] ?? '';
    $this->date_employed          = $args['date_employed'] ?? '';
    $this->employment_type        = $args['employment_type'] ?? '';
    $this->present_salary         = $args['present_salary'] ?? '';
    $this->grade_step             = $args['grade_step'] ?? '';
    $this->bank_name              = $args['bank_name'] ?? '';
    $this->account_number         = $args['account_number'] ?? '';
    $this->blood_group            = $args['blood_group'] ?? '';
    $this->company_id             = $args['company_id'] ?? '';
    $this->photo                  = $args['photo'] ?? '';
    $this->notification           = $args['notification'] ?? '';
    $this->update_profile         = $args['update_profile'] ?? 0;
    $this->created_at             = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted                = $args['deleted'] ?? '';
    $this->password               = $args['password'] ?? '';
    $this->confirm_password       = $args['confirm_password'] ?? '';
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

  public static function find_by_company_total_salary($companyName, $options = [])
  {
    $branch = $options['branch'] ?? false;

    $sql = "SELECT company, branch, COUNT(employee_id) AS counts, SUM(present_salary) AS total_salary FROM " . static::$table_name . " ";

    if ($companyName == 'not set' || $companyName == '') :
      $sql .= "WHERE company='' ";
    else :
      if (gettype($companyName) == 'array') return;
      $sql .= "WHERE company LIKE '%" . self::$database->escape_string($companyName) . "%'";
    endif;

    if (!$branch) :
      $obj_array = static::find_by_sql($sql);
      if (!empty($obj_array)) :
        return array_shift($obj_array);
      else :
        return false;
      endif;

    else :
      $sql .= " GROUP BY branch";
      return static::find_by_sql($sql);

    endif;
  }

  public static function find_by_total_salary()
  {
    $sql = "SELECT COUNT(employee_id) AS counts, SUM(present_salary) AS total_salary FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);

    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
 

  public static function find_by_company_name($name, $options = [])
  {
    $companyName = $options['company'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";

    if ($companyName && $companyName != 'not set') :
      $sql .= "WHERE company LIKE '%" . self::$database->escape_string($companyName) . "%'";
    elseif ($companyName == 'not set') :
      $sql .= "WHERE company='' ";
    else :
      $sql .= "WHERE company='" . self::$database->escape_string($name) . "'";
    endif;

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " ORDER BY id ASC";
    return static::find_by_sql($sql);
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

  public static function find_by_gender($gender)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE gender='" . self::$database->escape_string($gender) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";
    $obj_array = static::find_by_sql($sql);
    // return $obj_array;
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
