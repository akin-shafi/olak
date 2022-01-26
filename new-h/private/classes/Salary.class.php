<?php
class Salary extends DatabaseObject
{
  protected static $table_name = "salaries";
  protected static $db_columns = ['id', 'employee_id', 'present_salary', 'loan', 'salary_advance','overtime_allowance','leave_allowance','other_allowance', 'other_deduction', 'note', 'present_days', 'payment_status', 'created_at', 'tax', 'pension', 'deleted'];

  public $id;
  public $employee_id;
  public $present_salary;
  public $loan; 
  public $salary_advance;
  public $overtime_allowance;
  public $leave_allowance;
  public $other_allowance; 
  public $other_deduction; 
  public $note; 
  public $present_days; 
  public $payment_status; 
  public $created_at; 
  

  // ? DEDUCTIONS
  public $tax;
  public $pension;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id                = $args['employee_id'] ?? '';
    $this->present_salary             = $args['present_salary'] ?? '';
    $this->loan                       = $args['loan'] ?? '';
    $this->salary_advance             = $args['salary_advance'] ?? '';
    $this->overtime_allowance         = $args['overtime_allowance'] ?? 0;
    $this->leave_allowance            = $args['leave_allowance'] ?? 0;
    $this->other_allowance            = $args['other_allowance'] ?? 0; 
    $this->other_deduction            = $args['other_deduction'] ?? 0; 
    $this->note                       = $args['note'] ?? ''; 
    $this->present_days               = $args['present_days'] ?? '';
    $this->payment_status             = $args['payment_status'] ?? 0;
    $this->created_at                 = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->tax                        = $args['tax'] ?? '';
    $this->pension                    = $args['pension'] ?? '';
    $this->deleted                    = $args['deleted'] ?? '';
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

  public static function find_by_created_at($created_at)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " AND created_at LIKE'%" . self::$database->escape_string($created_at) . "%'";
    return static::find_by_sql($sql);

  }


}
