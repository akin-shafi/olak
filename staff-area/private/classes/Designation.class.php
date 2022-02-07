<?php
class Designation extends DatabaseObject
{

  protected static $table_name = "designations";
  protected static $db_columns = ['id', 'designation_name', 'company_id', 'created_at', 'deleted'];

  public $id;
  public $designation_name;
  public $company_id;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->designation_name          = $args['designation_name'] ?? '';
    $this->company_id    = $args['company_id'] ?? '';
    $this->created_at    = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted       = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->designation_name)) {
      $this->errors[] = "Designation name is required.";
    }

    if (is_blank($this->company_id)) {
      $this->errors[] = "Department is required.";
    }

    return $this->errors;
  }


  public static function find_by_designation_name($designation_name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE designation_name='" . self::$database->escape_string($designation_name) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
