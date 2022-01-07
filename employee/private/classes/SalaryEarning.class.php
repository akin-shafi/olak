<?php
class SalaryEarning extends DatabaseObject
{
  protected static $table_name = "salary_earnings";
  protected static $db_columns = ['id', 'salary_id', 'basic_salary', 'house_rent', 'transport', 'medical', 'furniture', 'meal', 'created_at', 'deleted'];

  public $id;
  public $salary_id;

  // ? EARNINGS
  public $basic_salary;
  public $house_rent;
  public $transport;
  public $medical;
  public $furniture;
  public $meal;

  public $created_at;
  public $deleted;

  public $total_earnings;


  public function __construct($args = [])
  {
    $this->salary_id        = $args['salary_id'] ?? '';
    $this->basic_salary     = $args['basic_salary'] ?? '';
    $this->house_rent       = $args['house_rent'] ?? '';
    $this->transport        = $args['transport'] ?? '';
    $this->medical          = $args['medical'] ?? '';
    $this->furniture        = $args['furniture'] ?? '';
    $this->meal             = $args['meal'] ?? '';
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

  public static function find_by_earnings()
  {
    $sql = "SELECT (basic_salary + house_rent + transport + medical + furniture + meal) AS total_earnings FROM " . static::$table_name . " ";
    $sql .= " GROUP BY salary_id ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
