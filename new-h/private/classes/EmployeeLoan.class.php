<?php
class EmployeeLoan extends DatabaseObject
{
  protected static $table_name = "loans";
  protected static $db_columns = ['id', 'ref_no', 'employee_id', 'type', 'loan_duration', 'loan_deduction', 'amount', 'amount_paid', 'payment_method', 'date_requested', 'date_issued', 'status', 'file_upload', 'note', 'deleted'];

  public $id;
  public $ref_no;
  public $employee_id;
  public $type;
  public $loan_duration;
  public $loan_deduction;
  public $amount;
  public $amount_paid;
  public $payment_method;
  public $date_requested;
  public $date_issued;
  public $status;
  public $file_upload;
  public $note;
  public $deleted;

  public $total_loan_received;

  public function __construct($args = [])
  {
    $this->ref_no           = $args['ref_no'] ?? '';
    $this->employee_id      = $args['employee_id'] ?? '';
    $this->type             = $args['type'] ?? '';
    $this->loan_duration    = $args['loan_duration'] ?? '';
    $this->loan_deduction   = $args['loan_deduction'] ?? '';
    $this->amount           = $args['amount'] ?? '';
    $this->amount_paid      = $args['amount_paid'] ?? '';
    $this->payment_method   = $args['payment_method'] ?? '';
    $this->date_requested   = $args['date_requested'] ?? date('Y-m-d H:i:s');
    $this->date_issued      = $args['date_issued'] ?? '';
    $this->status           = $args['status'] ?? '';
    $this->file_upload      = $args['file_upload'] ?? '';
    $this->note             = $args['note'] ?? '';
    $this->deleted          = $args['deleted'] ?? '';
  }


  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->amount)) {
      $this->errors[] = "Loan amount is required.";
    }

    return $this->errors;
  }

  public static function find_by_employee_id($employee_id, $option = [])
  {
    $isRequested = $option['requested'] ?? false;
    $loanType = $option['type'] ?? false;

    $sql = "SELECT *, SUM(amount) AS total_loan_received FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";

    if ($isRequested) {
      $sql .= " AND date_requested LIKE'%" . self::$database->escape_string($isRequested) . "%'";
    }

    if ($loanType) {
      $sql .= " AND type=1";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_loan_term($option = [])
  {
    $loan_type = $option['loan_type'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE loans.type='" . self::$database->escape_string($loan_type) . "'";

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }
}
