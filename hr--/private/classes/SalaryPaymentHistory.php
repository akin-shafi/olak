<?php
class SalaryPaymentHistory extends DatabaseObject
{
  protected static $table_name = "salary_payment_histories";
  protected static $db_columns = ['id', 'employee_id', 'amount_paid', 'current_salary', 'payment_status', 'paid_at', 'deleted'];

  public $id;
  public $employee_id;
  public $current_salary;
  public $payment_status;
  public $paid_at;
  public $deleted;


  public $counts;

  public function __construct($args = [])
  {
    $this->employee_id                 = $args['employee_id'] ?? '';
    $this->amount_paid                 = $args['amount_paid'] ?? '';
    $this->current_salary              = $args['current_salary'] ?? '';
    $this->payment_status              = $args['payment_status'] ?? '';
    $this->paid_at                      = $args['paid_at'] ?? date('Y-m-d H:i:s');
    $this->deleted                     = $args['deleted'] ?? '';
  }



  public static function find_by_employee_id($employee_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
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
