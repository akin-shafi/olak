<?php
class LongTermLoan extends DatabaseObject
{
  protected static $table_name = "long_term_loans";
  protected static $db_columns = ['id', 'employee_id', 'amount_requested', 'amount_paid', 'commitment', 'date_requested', 'deduction_date', 'loan_duration', 'deleted'];

  public $id;
  public $employee_id;
  public $amount_requested;
  public $amount_paid;
  public $commitment;
  public $date_requested;
  public $deduction_date;
  public $loan_duration;
  public $deleted;

  public $total_amount;
  public $counts;

  public function __construct($args = [])
  {
    $this->employee_id        = $args['employee_id'] ?? '';
    $this->amount_requested   = $args['amount_requested'] ?? '';
    $this->amount_paid        = $args['amount_paid'] ?? 0;
    $this->commitment         = $args['commitment'] ?? '';
    $this->date_requested     = $args['date_requested'] ?? date('Y-m-d H:i:s');
    $this->deduction_date     = $args['deduction_date'] ?? '';
    $this->loan_duration     = $args['loan_duration'] ?? '';
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

  public static function find_loan_by_year($year)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE date_requested LIKE'%" . self::$database->escape_string($year) . "%'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " ORDER BY date_requested DESC";
    return static::find_by_sql($sql);
  }

  public static function find_by_employee_id($employee_id, $option = [])
  {
    $dateRequested = $option['requested'] ?? false;
    $deductedDate = $option['deduct_date'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";

    if ($dateRequested) {
      $sql .= "AND date_requested LIKE '%" . self::$database->escape_string($dateRequested) . "%'";
    }

    if ($deductedDate) {
      $sql .= "AND deduction_date LIKE '%" . self::$database->escape_string($deductedDate) . "%'";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_total_long_term_amount($option = [])
  {
    $currentMonth = $option['current'] ?? false;

    $sql = "SELECT COUNT(*) AS counts, SUM(amount_requested) AS total_amount, SUM(amount_paid) AS amount_paid FROM " . static::$table_name . " ";

    if ($currentMonth) {
      $sql .= "WHERE date_requested LIKE '%" . self::$database->escape_string($currentMonth) . "%'";
    }

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
