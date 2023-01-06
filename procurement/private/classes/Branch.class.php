<?php
class Branch extends DatabaseObject
{
  protected static $table_name = "branches";
  protected static $db_columns = ['id', 'company_id', 'name', 'address', 'city', 'state', 'established_in', 'created_at',  'deleted'];

  public $id;
  public $company_id;
  public $name;
  public $address;
  public $city;
  public $state;
  public $established_in;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->company_id     = $args['company_id'] ?? '';
    $this->name           = $args['name'] ?? '';
    $this->address        = $args['address'] ?? '';
    $this->city           = $args['city'] ?? '';
    $this->state          = $args['state'] ?? '';
    $this->established_in = $args['established_in'] ?? '';
    $this->created_at     = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted        = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->company_id)) {
      $this->errors[] = "Kindly select a company";
    }

    if (is_blank($this->name)) {
      $this->errors[] = " Branch name is required.";
    }

    return $this->errors;
  }

  public static function find_all_branch($option = [])
  {
    $compId = $option['company_id'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if (!empty($compId)) {
      $sql .= "AND company_id='" . self::$database->escape_string($compId) . "'";
    }

    $sql .= "ORDER BY name ASC";
    return static::find_by_sql($sql);
  }

  public static function find_by_company_id($cId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE company_id='" . self::$database->escape_string($cId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
