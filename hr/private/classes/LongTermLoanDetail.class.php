<?php
class LongTermLoanDetail extends DatabaseObject
{
  protected static $table_name = "long_term_loan_details";
  protected static $db_columns = ['id', 'ref_no', 'employee_id', 'type', 'commitment_duration', 'loan_repayment', 'balance', 'payment_method', 'status', 'note', 'file_uploads', 'issued_by', 'date_approved', 'created_at', 'deleted'];

  public $id;
  public $ref_no;
  public $employee_id;
  public $type;
  public $commitment_duration;
  public $loan_repayment;
  public $balance;
  public $payment_method;
  public $status;
  public $note;
  public $file_uploads;
  public $issued_by;
  public $date_approved;
  public $created_at;
  public $deleted;

  public $counts;

  public $total_loan_refunded;

  public function __construct($args = [])
  {
    $this->ref_no                 = $args['ref_no'] ?? '';
    $this->employee_id            = $args['employee_id'] ?? '';
    $this->type                   = $args['type'] ?? '';
    $this->commitment_duration    = $args['commitment_duration'] ?? '';
    $this->loan_repayment         = $args['loan_repayment'] ?? '';
    $this->balance                = $args['balance'] ?? '';
    $this->payment_method         = $args['payment_method'] ?? '';
    $this->status                 = $args['status'] ?? 1;
    $this->note                   = $args['note'] ?? '';
    $this->file_uploads           = $args['file_uploads'] ?? '';
    $this->issued_by              = $args['issued_by'] ?? '';
    $this->date_approved          = $args['date_approved'] ?? '';
    $this->created_at             = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted                = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->employee_id)) {
      $this->errors[] = "Employee name is required.";
    }

    return $this->errors;
  }


  public static function find_by_employee_id($employee_id, $option = [])
  {
    $isRequested = $option['requested'] ?? false;

    $sql = "SELECT *, SUM(loan_repayment) AS total_loan_refunded FROM " . static::$table_name . " ";
    $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";

    if ($isRequested) {
      $sql .= " AND created_at LIKE'%" . self::$database->escape_string($isRequested) . "%'";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_loan_approved($option = [])
  {
    $currentMonth = $option['current'] ?? false;
    $salaryStatus = $option['status'] ?? false;

    $sql = "SELECT COUNT(*) AS counts FROM " . static::$table_name . " ";

    if ($salaryStatus) {
      $sql .= " WHERE status='" . self::$database->escape_string($salaryStatus) . "'";
    }

    if ($currentMonth) {
      $sql .= " AND created_at LIKE '%" . self::$database->escape_string($currentMonth) . "%'";
    }

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
