<?php
class EmployeeAttendance extends DatabaseObject
{
  protected static $table_name = "employee_attendances";
  protected static $db_columns = ['id', 'employee_id', 'clock_in', 'clock_out', 'note', 'created_at'];

  public $id;
  public $employee_id;
  public $clock_in;
  public $clock_out;
  public $note;
  public $created_at;

  public function __construct($args = [])
  {
    $this->employee_id    = $args['employee_id'] ?? '';
    $this->clock_in       = $args['clock_in'] ?? date('h:i:s:a');
    $this->clock_out      = $args['clock_out'] ?? '';
    $this->note           = $args['note'] ?? '';
    $this->created_at     = $args['created_at'] ?? date('Y-m-d H:i:s');
  }

  public static function find_by_employee_id($employee_id, $option = [])
  {
    $clockIn = $option['clocked_in'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";

    if ($clockIn) {
      $sql .= " AND created_at LIKE'%" . self::$database->escape_string($clockIn) . "%'";
    }

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
