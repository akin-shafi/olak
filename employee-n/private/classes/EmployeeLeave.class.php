<?php
class EmployeeLeave extends DatabaseObject
{

  protected static $table_name = "leaves";
  protected static $db_columns = ['id', 'employee_id', 'leave_type', 'date_from', 'date_to', 'duration', 'reason', 'status', 'approved_by', 'date_approved', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $leave_type;
  public $date_from;
  public $date_to;
  public $duration;
  public $reason;
  public $status;
  public $approved_by;
  public $date_approved;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->leave_type       = $args['leave_type'] ?? '';
    $this->date_from        = $args['date_from'] ?? '';
    $this->date_to          = $args['date_to'] ?? '';
    $this->duration         = $args['duration'] ?? '';
    $this->reason           = $args['reason'] ?? '';
    $this->status           = $args['status'] ?? 1;
    $this->approved_by      = $args['approved_by'] ?? '';
    $this->date_approved    = $args['date_approved'] ?? date('Y-m-d');
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Department name is required.";
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

  public static function find_by_employee_leaves($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }
}
