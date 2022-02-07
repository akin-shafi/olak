<?php
class Configuration extends DatabaseObject
{
  protected static $table_name = "configurations";
  protected static $db_columns = ['id', 'loan_config'];

  public $id;
  public $loan_config;

  public $counts;

  public function __construct($args = [])
  {
    $this->loan_config     = $args['loan_config'] ?? 0;
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
}
