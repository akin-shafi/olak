<?php
class Configuration extends DatabaseObject
{
  protected static $table_name = "configurations";
  protected static $db_columns = ['id', 'loan_config', 'process_salary', 'visibility', 'process_salary_date'];

  public $id;
  public $loan_config;
  public $process_salary;
  public $visibility;
  public $process_salary_date;

  public $counts;

  public function __construct($args = [])
  {
    $this->loan_config     = $args['loan_config'] ?? 0;
    $this->process_salary  = $args['process_salary'] ?? 0;
    $this->visibility      = $args['visibility'] ?? 0;
    $this->process_salary_date     = $args['process_salary_date'] ?? date('Y-m-d');
  }

  public static function find_by_loan_config($loan_config)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE loan_config='" . self::$database->escape_string($loan_config) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  

  public static function find_by_date($month)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    // $sql = "SELECT DATE_FORMAT(process_salary_date,'%Y%m') AS date FROM " . static::$table_name . " ";
    $sql .= "WHERE process_salary_date LIKE'%" . self::$database->escape_string($month) . "%'";
    
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_process_salary($options=[])
  {
    $process_salary = $options['process_salary'] ?? false;
    $process_salary_date = $options['process_salary_date'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE process_salary='" . self::$database->escape_string($process_salary) . "'";
    $sql .= " AND process_salary_date LIKE'%" . self::$database->escape_string($process_salary_date) . "%'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
