<?php
class EmployeeExperience extends DatabaseObject
{
  protected static $table_name = "employee_experience";
  protected static $db_columns = ['id', 'employee_id', 'company_name', 'location', 'job_position', 'period_from', 'period_to', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $company_name;
  public $location;
  public $job_position;
  public $period_from;
  public $period_to;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id    = $args['employee_id'] ?? '';
    $this->company_name   = $args['company_name'] ?? '';
    $this->location       = $args['location'] ?? '';
    $this->job_position   = $args['job_position'] ?? '';
    $this->period_from    = $args['period_from'] ?? '';
    $this->period_to      = $args['period_to'] ?? '';
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
