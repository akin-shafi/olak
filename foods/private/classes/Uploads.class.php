<?php
class Uploads extends DatabaseObject
{
  protected static $table_name = "Uploads";
  protected static $db_columns = ['id', 'file_name', 'cash_flow_id', 'created_at', 'deleted'];

  public $id;
  public $file_name;
  public $cash_flow_id;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->file_name    = $args['file_name'] ?? '';
    $this->cash_flow_id = $args['cash_flow_id'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    // if (is_blank($this->file_name)) {
    //   $this->errors[] = "File upload is required.";
    // }

    return $this->errors;
  }

  public static function find_by_date($date)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at='" . self::$database->escape_string($date) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }
}
