<?php
class EmployeeDetail extends DatabaseObject
{
  protected static $table_name = "employee_details";
  protected static $db_columns = ['id', 'employee_id', 'account_name', 'bank_name', 'account_number', 'kin_name', 'kin_relationship', 'kin_phone_1', 'kin_phone_2', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $account_name;
  public $bank_name;
  public $account_number;
  public $kin_name;
  public $kin_relationship;
  public $kin_phone_1;
  public $kin_phone_2;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->account_name     = $args['account_name'] ?? '';
    $this->bank_name        = $args['bank_name'] ?? '';
    $this->account_number   = $args['account_number'] ?? '';
    $this->kin_name         = $args['kin_name'] ?? '';
    $this->kin_relationship = $args['kin_relationship'] ?? '';
    $this->kin_phone_1      = $args['kin_phone_1'] ?? '';
    $this->kin_phone_2      = $args['kin_phone_2'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
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
