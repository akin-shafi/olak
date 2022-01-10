<?php
class SalaryDeduction extends DatabaseObject
{
  protected static $table_name = "salary_deductions";
  protected static $db_columns = ['id', 'salary_id', 'tax', 'pension', 'others', 'created_at', 'deleted'];

  public $id;
  public $salary_id;
  public $tax;
  public $pension;
  public $others;

  public $created_at;
  public $deleted;

  public $total_deductions;

  public function __construct($args = [])
  {
    $this->salary_id        = $args['salary_id'] ?? '';
    $this->tax              = $args['tax'] ?? '';
    $this->pension          = $args['pension'] ?? '';
    $this->others           = $args['others'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  public static function find_by_salary_id($salary_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE salary_id='" . self::$database->escape_string($salary_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_deductions($salary_id)
  {
    $sql = "SELECT (tax + pension) AS total_deductions FROM " . static::$table_name . " ";
    $sql .= "WHERE salary_id='" . self::$database->escape_string($salary_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
