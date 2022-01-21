<?php
class LongTermLoan extends DatabaseObject
{

  protected static $table_name = "long_term_loans";
  protected static $db_columns = ['id', 'employee_id', 'amount_requested', 'commitment', 'date_requested', 'deleted'];

  public $id;
  public $employee_id;
  public $amount_requested;
  public $commitment;
  public $date_requested;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id        = $args['employee_id'] ?? '';
    $this->amount_requested   = $args['amount_requested'] ?? '';
    $this->commitment         = $args['commitment'] ?? '';
    $this->date_requested     = $args['date_requested'] ?? date('Y-m-d H:i:s');
    $this->deleted            = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Employee name is required.";
    }

    return $this->errors;
  }


  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
