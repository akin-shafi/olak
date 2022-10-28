<?php
class Department extends DatabaseObject
{

  protected static $table_name = "departments";
  protected static $db_columns = ['id', 'department_name', 'created_at', 'deleted'];

  public $id;
  public $department_name;
  public $created_at;
  public $deleted;


  public $counts;

  public function __construct($args = [])
  {
    $this->department_name  = $args['department_name'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->department_name)) {
      $this->errors[] = "Department name is required.";
    }

    return $this->errors;
  }

  public static function find_by_department_name($department_name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE department_name='" . self::$database->escape_string($department_name) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
