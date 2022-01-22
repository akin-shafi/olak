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

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->total_requested  = $args['total_requested'] ?? '';
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