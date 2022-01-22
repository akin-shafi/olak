<?php
class Payroll extends DatabaseObject
{

  protected static $table_name = "payrolls";
  protected static $db_columns = ['id', 'employee_id', 'salary', 'short_loan', 'long_loan', 'other_expenses', 'present_days', 'take_home', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $salary;
  public $short_loan;
  public $long_loan;
  public $other_expenses;
  public $present_days;
  public $take_home;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->salary           = $args['salary'] ?? '';
    $this->short_loan       = $args['short_loan'] ?? '';
    $this->long_loan        = $args['long_loan'] ?? '';
    $this->other_expenses   = $args['other_expenses'] ?? '';
    $this->present_days     = $args['present_days'] ?? '';
    $this->take_home        = $args['take_home'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->salary)) {
      $this->errors[] = "Salary name is required.";
    }

    return $this->errors;
  }


  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
