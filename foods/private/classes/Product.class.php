<?php
class Product extends DatabaseObject
{
  protected static $table_name = "products";
  protected static $db_columns = ['id', 'product_type', 'name', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $product_type;
  public $name;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  const PRODUCT_TYPE = [
    '1' => 'Input',
    '2' => 'Output',
  ];

  public function __construct($args = [])
  {
    $this->product_type = $args['product_type'] ?? '';
    $this->name         = $args['name'] ?? '';
    $this->created_by   = $args['created_by'] ?? '';
    $this->updated_at   = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->product_type)) {
      $this->errors[] = "Product type is required.";
    }

    if (is_blank($this->name)) {
      $this->errors[] = "Product name is required.";
    }

    return $this->errors;
  }

  static public function find_all_products($type)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE product_type='" . self::$database->escape_string($type) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " ORDER BY name ASC ";
    return static::find_by_sql($sql);
  }
}
