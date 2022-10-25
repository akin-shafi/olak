<?php
class AccessControl extends DatabaseObject
{
  protected static $table_name = "access_control";
  protected static $db_columns = ['id', 'admin_id', 'company_id', 'branch_id', 'deleted'];

  public $id;
  public $admin_id;
  public $company_id;
  public $branch_id;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->admin_id     = $args['admin_id'] ?? '';
    $this->company_id   = $args['company_id'] ?? '';
    $this->branch_id    = $args['branch_id'] ?? '';
    $this->deleted      = $args['deleted'] ?? '';
  }

  public static function find_by_admin_id($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE admin_id='" . self::$database->escape_string($name) . "'";
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
