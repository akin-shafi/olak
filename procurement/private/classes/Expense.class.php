<?php
class Expense extends DatabaseObject
{
  protected static $table_name = "expenses";
  protected static $db_columns = ['id', 'company_id', 'branch_id', 'expense_type',  'product', 'quantity', 'amount', 'narration', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $company_id;
  public $branch_id;
  public $expense_type;
  public $product;
  public $quantity;
  public $amount;
  public $narration;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $total_amount;

  public $year;
  public $month;
  public $outflow;

  const EXPENSE_TYPE = [
    1 => 'Credit sales',
    2 => 'Operating',
    3 => 'Non-operating',
    4 => 'Head office',
    5 => 'Transfer',
  ];

  public function __construct($args = [])
  {
    $this->company_id   = $args['company_id'] ?? '';
    $this->branch_id    = $args['branch_id'] ?? '';
    $this->expense_type = $args['expense_type'] ?? '';
    $this->product      = $args['product'] ?? '';
    $this->quantity     = $args['quantity'] ?? '';
    $this->amount       = $args['amount'] ?? '';
    $this->narration    = $args['narration'] ?? '';
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
    $expense = $option['expense'] ?? false;

    if ($expense != false) {
      $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
      $sql .= "WHERE expense_type='" . self::$database->escape_string($expense) . "'";
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
    $expense = $option['expense'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    if ($expense != false) {
      $sql .= " AND expense_type='" . self::$database->escape_string($expense) . "'";
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
