<?php
class Salary extends DatabaseObject
{
  protected static $table_name = "salaries";
  protected static $db_columns = ['id', 'employee_id', 'net_salary', 'payment_status', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $net_salary;

  // public $monthly_gross_salary;
  public $payment_status;
  public $created_at;
  public $deleted;

  public $e_id; //* earning's ID
  public $d_id; //* deduction's ID

  // ? EARNINGS
  public $actual_amount;
  public $basic_salary;
  public $housing;
  public $dressing;
  public $transport;
  public $utility;
  public $other_earning;
  public $other_deduction;

  // ? DEDUCTIONS
  public $tax;
  public $pension;


  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->net_salary       = $args['net_salary'] ?? '';
    $this->payment_status   = $args['payment_status'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Kindly select an employee";
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

  public static function find_by_salaries($salary_id)
  {
    $sql = "SELECT *, se.id AS e_id, sd.id AS d_id, se.others AS other_earning, sd.others AS other_deduction FROM " . static::$table_name . " ";

    $sql .= " JOIN salary_earnings AS se ON salaries.id = se.salary_id";
    $sql .= " JOIN salary_deductions AS sd ON salaries.id = sd.salary_id";
    $sql .= " WHERE salaries.id='" . self::$database->escape_string($salary_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
