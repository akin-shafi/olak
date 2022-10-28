<?php
class PayrollOvertime extends DatabaseObject
{
  protected static $table_name = "payroll_overtime";
  protected static $db_columns = ['id', 'name', 'value', 'created_at', 'deleted'];

  public $id;
  public $name;
  public $value;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->name         = $args['name'] ?? '';
    $this->value        = $args['value'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }
}
