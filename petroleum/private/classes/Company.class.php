<?php
class Company extends DatabaseObject
{
  protected static $table_name = "companies";
  protected static $db_columns = ['id', 'full_name', 'email', 'phone', 'name', 'address', 'reg_no', 'logo', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $full_name;
  public $email;
  public $phone;
  public $name;
  public $address;
  public $reg_no;
  public $logo;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->full_name  = $args['full_name'] ?? '';
    $this->email      = $args['email'] ?? '';
    $this->phone      = $args['phone'] ?? '';
    $this->name       = $args['name'] ?? '';
    $this->address    = $args['address'] ?? '';
    $this->reg_no     = $args['reg_no'] ?? '';
    $this->logo       = $args['logo'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? '';
    $this->deleted    = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->full_name)) {
      $this->errors[] = "Owner's name is required.";
    }

    if (is_blank($this->phone)) {
      $this->errors[] = "Company phone number is required.";
    }

    if (is_blank($this->name)) {
      $this->errors[] = "Company name is required.";
    }

    return $this->errors;
  }

  public static function find_all_company()
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY name ASC";
    return static::find_by_sql($sql);
  }

  public static function name($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE name='" . self::$database_hr->escape_string($name) . "'";
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
