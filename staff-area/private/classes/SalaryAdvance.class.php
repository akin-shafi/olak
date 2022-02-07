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

  public static function clear_loan_requests($thisMonth)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE created_at LIKE'%" . self::$database->escape_string($thisMonth) . "%'";
    return static::find_by_sql($sql);
  }
}
