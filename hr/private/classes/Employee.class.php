<?php
class Employee extends DatabaseObject
{

  protected static $table_name = "employees";
  protected static $db_columns = ['id', 'photo', 'employee_id', 'first_name', 'last_name', 'department_id', 'designation_id', 'location', 'job_title', 'phone', 'email', 'address', 'hashed_password', 'gender', 'marital_status', 'dob', 'kin_name', 'kin_phone', 'highest_qualification', 'date_employed', 'bank_name', 'bank_account', 'professional_body', 'current_salary', 'grade', 'step', 'created_at', 'deleted'];

  public $id;
  public $photo;
  public $employee_id;
  public $first_name;
  public $last_name;
  public $department_id;
  public $designation_id;
  public $location;
  public $job_title;
  public $phone;
  public $email;
  public $gender;
  public $address;
  public $marital_status;
  public $dob;
  public $kin_name;
  public $kin_phone;
  public $highest_qualification;
  public $date_employed;
  public $bank_name;
  public $bank_account;
  public $professional_body;
  public $current_salary;
  public $grade;
  public $step;
  public $created_at;
  public $deleted;

  protected $password_required = true;
  public $hashed_password;
  public $password;
  public $confirm_password;

  public $counts;

  public function __construct($args = [])
  {
    $this->photo                    = $args['photo'] ?? '';
    $this->employee_id              = $args['employee_id'] ?? '';
    $this->first_name               = $args['first_name'] ?? '';
    $this->last_name                = $args['last_name'] ?? '';
    $this->password                 = $args['password'] ?? '';
    $this->confirm_password         = $args['confirm_password'] ?? '';


    $this->company_id               = $args['company_id'] ?? '';
    $this->branch_id                = $args['branch_id'] ?? '';
    $this->department_id            = $args['department_id'] ?? '';
    $this->designation_id           = $args['designation_id'] ?? '';
    $this->job_title                = $args['job_title'] ?? '';
    $this->phone                    = $args['phone'] ?? '';
    $this->email                    = $args['email'] ?? '';
    $this->gender                   = $args['gender'] ?? '';
    $this->address                  = $args['address'] ?? '';
    $this->marital_status           = $args['marital_status'] ?? '';
    $this->dob                      = $args['dob'] ?? '';
    $this->kin_name                 = $args['kin_name'] ?? '';
    $this->kin_phone                = $args['kin_phone'] ?? '';
    $this->highest_qualification    = $args['highest_qualification'] ?? '';
    $this->date_employed            = $args['date_employed'] ?? '';
    $this->bank_name                = $args['bank_name'] ?? '';
    $this->bank_account             = $args['bank_account'] ?? '';
    $this->professional_body        = $args['professional_body'] ?? '';
    $this->created_at               = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted                  = $args['deleted'] ?? '';
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

    if (is_blank($this->department_id)) {
      $this->errors[] = "Department is required.";
    }

    if (is_blank($this->designation_id)) {
      $this->errors[] = "Designation is required.";
    }

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Employee ID is required.";
    }

    if (is_blank($this->date_employed)) {
      $this->errors[] = "Employment date is required.";
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
}
