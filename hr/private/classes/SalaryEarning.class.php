<?php
class SalaryEarning extends DatabaseObject
{
  protected static $table_name = "salary_earnings";
  protected static $db_columns = ['id', 'salary_id', 'actual_amount', 'basic_salary', 'housing', 'dressing', 'transport', 'utility', 'others', 'created_at', 'deleted'];

  public $id;
  public $salary_id;

  // ? EARNINGS
  public $actual_amount;
  public $basic_salary;
  public $housing;
  public $dressing;
  public $transport;
  public $utility;
  public $others;

  public $created_at;
  public $deleted;

  public $total_earnings;


  public function __construct($args = [])
  {
    $this->salary_id        = $args['salary_id'] ?? '';
    $this->actual_amount    = $args['actual_amount'] ?? '';
    $this->basic_salary     = $args['basic_salary'] ?? '';
    $this->housing          = $args['housing'] ?? '';
    $this->dressing         = $args['dressing'] ?? '';
    $this->transport        = $args['transport'] ?? '';
    $this->utility          = $args['utility'] ?? '';
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

  public static function find_by_earnings($salary_id)
  {
    $sql = "SELECT (basic_salary + housing + dressing + transport + utility + others) AS total_earnings FROM " . static::$table_name . " ";
    $sql .= "WHERE salary_id='" . self::$database->escape_string($salary_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
