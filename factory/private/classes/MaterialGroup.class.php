<?php
class MaterialGroup extends DatabaseObject
{
  protected static $table_name = "raw_material_groups";
  protected static $db_columns = ['id', 'name', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $name;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->name         = $args['name'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at   = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->name)) {
      $this->errors[] = "Group name is required.";
    }

    return $this->errors;
  }

  public static function find_by_group_id($groupId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE id='" . self::$database->escape_string($groupId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}