<?php
class CashFlow extends DatabaseObject
{
  protected static $table_name = "cash_flow";
  protected static $db_columns = ['id', 'credit_sales', 'cash_sales', 'pos', 'transfer', 'narration', 'company_id', 'branch_id', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $credit_sales;
  public $cash_sales;
  public $pos;
  public $transfer;
  public $narration;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $total_amount;

  public function __construct($args = [])
  {
    $this->credit_sales = $args['credit_sales'] ?? 0;
    $this->cash_sales   = $args['cash_sales'] ?? 0;
    $this->pos          = $args['pos'] ?? 0;
    $this->transfer     = $args['transfer'] ?? 0;
    $this->narration    = $args['narration'] ?? '';
    $this->company_id   = $args['company_id'] ?? '';
    $this->branch_id    = $args['branch_id'] ?? '';
    $this->created_by   = $args['created_by'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at   = $args['updated_at'] ?? '';
    $this->deleted      = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->credit_sales)) {
      $this->errors[] = "Credit sales is required.";
    }

    if (is_blank($this->cash_sales)) {
      $this->errors[] = "Cash sales is required.";
    }

    if (is_blank($this->pos)) {
      $this->errors[] = "POS sales is required.";
    }

    return $this->errors;
  }

  public static function single_cash_flow($dateFrom, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at >='" . self::$database->escape_string($dateFrom) . "'";

    if (empty($company) && !empty($branch)) :
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_cash_flow($dateFrom, $dateTo, $option = [])
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

    return static::find_by_sql($sql);
  }

  public static function get_total_remittance($dateFrom)
  {
    $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
    $sql .= "WHERE created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
