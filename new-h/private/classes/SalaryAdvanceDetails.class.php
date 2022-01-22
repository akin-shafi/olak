<?php
class SalaryAdvanceDetails extends DatabaseObject
{

  protected static $table_name = "salary_advance_details";
  protected static $db_columns = ['id','ref_no', 'employee_id', 'amount', 'date_requested', 'date_issued', 'status', 'file_upload', 'created_at', 'deleted'];

  public $id;
  public $employee_id;
  public $ref_no;
  public $amount;
  public $date_requested;
  public $date_issued;
  public $status;
  public $file_upload;
  public $created_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->ref_no           = $args['ref_no'] ?? '';
    $this->amount           = $args['amount'] ?? '';
    $this->date_requested   = $args['date_requested'] ?? '';
    $this->date_issued      = $args['date_issued'] ?? '';
    $this->status           = $args['status'] ?? '';
    $this->file_upload      = $args['file_upload'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->salary)) {
      $this->errors[] = "Salary name is required.";
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
