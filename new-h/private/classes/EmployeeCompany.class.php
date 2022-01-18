<?php
class EmployeeCompany extends DatabaseObject
{
  protected static $table_name = "employee_companies";
  protected static $db_columns = ['id', 'employee_id', 'employee_number', 'department_id', 'designation_id', 'date_employed', 'reg_date', 'terminate_date', 'salary_type', 'salary', 'created_at', 'deleted'];


  public $id;
  public $employee_id;
  public $employee_number;
  public $department_id;
  public $designation_id;
  public $date_employed;
  public $reg_date;
  public $terminate_date;
  public $salary_type;
  public $salary;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {

    $this->employee_id      = $args['employee_id'] ?? '';
    $this->employee_number  = $args['employee_number'] ?? '';
    $this->department_id    = $args['department_id'] ?? '';
    $this->designation_id   = $args['designation_id'] ?? '';
    $this->date_employed    = $args['date_employed'] ?? '';
    $this->reg_date         = $args['reg_date'] ?? '';
    $this->terminate_date   = $args['terminate_date'] ?? '';
    $this->salary_type      = $args['salary_type'] ?? '';
    $this->salary           = $args['salary'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Employee name is required.";
    }

    return $this->errors;
  }


  public static function find_by_employee_id($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($name) . "'";
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
