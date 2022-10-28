<?php
class EmployeeDocument extends DatabaseObject
{
  protected static $table_name = "employee_docs";
  protected static $db_columns = ['id', 'employee_id', 'cv', 'id_card', 'offer_letter', 'acceptance_letter', 'agreement_letter',  'created_at', 'deleted'];


  public $id;
  public $employee_id;
  public $cv;
  public $id_card;
  public $offer_letter;
  public $acceptance_letter;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {

    $this->employee_id        = $args['employee_id'] ?? '';
    $this->cv                 = $args['cv'] ?? '';
    $this->id_card            = $args['id_card'] ?? '';
    $this->offer_letter       = $args['offer_letter'] ?? '';
    $this->acceptance_letter  = $args['acceptance_letter'] ?? '';
    $this->agreement_letter   = $args['agreement_letter'] ?? '';
    $this->created_at         = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted            = $args['deleted'] ?? '';
  }

  // protected function validate()
  // {
  //   $this->errors = [];

  //   if (is_blank($this->cv)) {
  //     $this->errors[] = "Account holder is required.";
  //   }

  //   return $this->errors;
  // }


  public static function find_by_employee_id($name)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($name) . "'";
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
