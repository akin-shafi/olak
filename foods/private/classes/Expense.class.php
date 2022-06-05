<?php
class Expense extends DatabaseObject
{
  protected static $table_name = "expenses";
  protected static $db_columns = ['id', 'company_id', 'branch_id', 'title', 'quantity', 'amount', 'narration', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $company_id;
  public $branch_id;
  public $title;
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

  public function __construct($args = [])
  {
    $this->company_id   = $args['company_id'] ?? '';
    $this->branch_id    = $args['branch_id'] ?? '';
    $this->title        = $args['title'] ?? '';
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

  public static function get_total_expenses($dateFrom, $dateTo, $option = [])
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
      $sql .= "WHERE created_at >='" . self::$database->escape_string($dateFrom) . "'";
      $sql .= " AND created_at <='" . self::$database->escape_string($dateTo) . "'";
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


  public static function find_by_expenses($dateFrom, $dateTo, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at >='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND created_at <='" . self::$database->escape_string($dateTo) . "'";

    if (empty($company) && !empty($branch)) :
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

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
