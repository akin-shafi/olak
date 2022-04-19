<?php
class Expense extends DatabaseObject
{
  protected static $table_name = "expenses";
  protected static $db_columns = ['id', 'expense_type',  'product', 'quantity', 'amount', 'narration', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
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

  const EXPENSE_TYPE = [
    1 => 'credit sales',
    2 => 'operating',
    3 => 'non-operating',
    4 => 'head office',
  ];

  public function __construct($args = [])
  {
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

  public static function find_by_product($pId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE product='" . self::$database->escape_string($pId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function get_total_expenses($option = [])
  {
    $expense = $option['expense'] ?? false;

    if ($expense != false) {
      $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
      $sql .= "WHERE expense_type='" . self::$database->escape_string($expense) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    } else {
      $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    }

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }


  public static function find_by_expense_type($option = [])
  {
    $expense = $option['expense'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($expense != false) {
      $sql .= " AND expense_type='" . self::$database->escape_string($expense) . "'";
    }

    return static::find_by_sql($sql);
  }
}
