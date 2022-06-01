<?php
class MaterialCategory extends DatabaseObject
{
  protected static $table_name = "raw_material_categories";
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
      $this->errors[] = "Category name is required.";
    }

    return $this->errors;
  }
}
