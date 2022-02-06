<?php
class EmployeeBank extends DatabaseObject
{
  protected static $table_name = "employee_banks";
  protected static $db_columns = ['id', 'employee_id', 'account_holder', 'account_number', 'bank_name', 'bank_location', 'created_at', 'deleted'];


  public $id;
  public $employee_id;
  public $account_holder;
  public $account_number;
  public $bank_name;
  public $bank_location;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {

    $this->employee_id      = $args['employee_id'] ?? '';
    $this->account_holder     = $args['account_holder'] ?? '';
    $this->account_number   = $args['account_number'] ?? '';
    $this->bank_name        = $args['bank_name'] ?? '';
    $this->bank_location    = $args['bank_location'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->account_holder)) {
      $this->errors[] = "Account holder is required.";
    }

    return $this->errors;
  }


  public static function find_by_employee_id($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($name) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
