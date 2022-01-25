<?php
class PayrollNarration extends DatabaseObject
{

  protected static $table_name = "payroll_narrations";
  protected static $db_columns = ['id', 'employee_id', 'overtime_allowance', 'leave_allowance', 'other_allowance', 'other_deduction', 'note', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $overtime_allowance;
  public $leave_allowance;
  public $other_allowance;
  public $other_deduction;
  public $note;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id          = $args['employee_id'] ?? '';
    $this->overtime_allowance   = $args['overtime_allowance'] ?? '';
    $this->leave_allowance      = $args['leave_allowance'] ?? '';
    $this->other_allowance      = $args['other_allowance'] ?? '';
    $this->other_deduction      = $args['other_deduction'] ?? '';
    $this->note                 = $args['note'] ?? '';
    $this->created_at           = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted              = $args['deleted'] ?? '';
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
