<?php
class EmployeeEducation extends DatabaseObject
{
  protected static $table_name = "employee_education";
  protected static $db_columns = ['id', 'employee_id', 'institution', 'subject', 'start_date', 'complete_date', 'degree', 'grade', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $institution;
  public $subject;
  public $start_date;
  public $complete_date;
  public $degree;
  public $grade;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id    = $args['employee_id'] ?? '';
    $this->institution    = $args['institution'] ?? '';
    $this->subject        = $args['subject'] ?? '';
    $this->start_date     = $args['start_date'] ?? '';
    $this->complete_date  = $args['complete_date'] ?? '';
    $this->created_at     = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted        = $args['deleted'] ?? '';
  }

  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }
}
