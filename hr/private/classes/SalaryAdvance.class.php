<?php
class SalaryAdvance extends DatabaseObject
{
  protected static $table_name = "salary_advances";
  protected static $db_columns = ['id', 'employee_id', 'total_requested', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $total_requested;
  public $created_at;
  public $deleted;

  public $total_loan_received;
  public $total_amount;
  public $counts;
  public $status;

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->total_requested  = $args['total_requested'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }


  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT *, SUM(total_requested) AS total_loan_received FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_total_salary_advance_amount($option = [])
  {
    $currentMonth = $option['current'] ?? false;
    $salaryStatus = $option['status'] ?? false;

    $sql = "SELECT COUNT(salary_advances.id) AS counts, SUM(salary_advances.total_requested) AS total_amount, salary_advance_details.status FROM " . static::$table_name . " ";
    $sql .= "JOIN salary_advance_details ON salary_advances.employee_id = salary_advance_details.employee_id";

    if ($currentMonth) {
      $sql .= " WHERE created_at LIKE '%" . self::$database->escape_string($currentMonth) . "%'";
    }

    if ($salaryStatus == 1) {
      $sql .= " AND status='" . self::$database->escape_string($salaryStatus) . "'";
    }

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function clear_loan_requests($thisMonth)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE created_at LIKE'%" . self::$database->escape_string($thisMonth) . "%'";
    return static::find_by_sql($sql);
  }
}
