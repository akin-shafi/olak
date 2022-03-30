<?php
class Company extends DatabaseObjectHR
{
  protected static $table_name = "companies";
  protected static $db_columns = ['id', 'logo', 'company_name', 'registration_no', 'created_at',  'deleted'];

  public $id;
  public $logo;
  public $company_name;
  public $registration_no;
  public $created_at;
  public $deleted;


  public $counts;

  public function __construct($args = [])
  {
    $this->logo            = $args['logo'] ?? '';
    $this->company_name    = $args['company_name'] ?? '';
    $this->registration_no = $args['registration_no'] ?? '';
    $this->created_at      = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted         = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->company_name)) {
      $this->errors[] = "Company name is required.";
    }

    return $this->errors;
  }

  public static function find_all_company()
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY company_name ASC";
    return static::find_by_sql($sql);
  }

  public static function find_by_company_name($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE company_name='" . self::$database_hr->escape_string($name) . "'";
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
