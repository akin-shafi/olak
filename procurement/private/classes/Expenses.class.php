<?php
class Expenses extends DatabaseObject
{
  protected static $table_name = "expenses";
  protected static $db_columns =  ['id', 'company_id', 'branch_id', 'date', 'expense_type', 'amount', 'paid_through', 'vendor', 'reference', 'note', 'created_by', 'created_at', 'updated_at', 'deleted'];
  public $id;                     // id
  public $company_id;             // company_id
  public $branch_id;              // branch_id
  public $date;                   // date
  public $expense_type;        // expense_type
  public $amount;                 // amount
  public $paid_through;           // paid_through
  public $vendor;                 // vendor
  public $reference;              // reference
  public $note;                   // note
  public $created_by;             // created_by
  public $created_at;             // created_at
  public $updated_at;             // updated_at
  public $deleted;                // deleted
  
  // public $total_amount;           // (No corresponding column in the table)
  
  // public $year;                   // (No corresponding column in the table)
  // public $month;                  // (No corresponding column in the table)
  // public $outflow;                // (No corresponding column in the table)
  

  const EXPENSE_TYPE = [
    1 => 'Credit sales',
    2 => 'Operating',
    3 => 'Non-operating',
    4 => 'Head office',
    5 => 'Transfer',
  ];

  const PAID_THROUGH = [
    1 => 'Petty Cash',
    2 => 'Undeposited Cash',
    3 => 'Bank Transfer',
    4 => 'Cheque',
  ];

  public function __construct($args = [])
  {
    $this->company_id   = $args['company_id'] ?? '';
    $this->branch_id    = $args['branch_id'] ?? '';
    $this->date      = $args['date'] ?? '';
    $this->expense_type = $args['expense_type'] ?? '';
    $this->amount       = $args['amount'] ?? '';
    $this->paid_through     = $args['paid_through'] ?? '';
    
    $this->vendor    = $args['vendor'] ?? '';
    $this->reference    = $args['reference'] ?? '';
    $this->note    = $args['note'] ?? '';
    $this->created_by   = $args['created_by'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at   = $args['updated_at'] ?? '';
    $this->deleted      = $args['deleted'] ?? '';
  }

  public static function find_by_expense($expId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expense_type='" . self::$database->escape_string($expId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function get_total_expenses($dateFrom, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;
    $expense_type = $option['expense_type'] ?? false;

    if ($expense_type != false) {
      $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
      $sql .= "WHERE expense_type='" . self::$database->escape_string($expense_type) . "'";
      $sql .= "AND created_at ='" . self::$database->escape_string($dateFrom) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    } else {
      $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
      $sql .= "WHERE created_at ='" . self::$database->escape_string($dateFrom) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    }

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }


  public static function find_by_expense_type($dateFrom, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;
    $expense_type = $option['expense_type'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    if ($expense_type != false) {
      $sql .= " AND expense_type='" . self::$database->escape_string($expense_type) . "'";
    }

    return static::find_by_sql($sql);
  }

  public static function find_by_metrics()
  {
    $sql = "SELECT year(created_at) AS year, month(created_at) AS month, SUM(amount) AS outflow  FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "GROUP BY year(created_at), month(created_at) ";
    $sql .= "ORDER BY year(created_at), month(created_at) ";

    return static::find_by_sql($sql);
  }
}
