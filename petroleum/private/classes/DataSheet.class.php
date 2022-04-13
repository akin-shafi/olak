<?php
class DataSheet extends DatabaseObject
{
  protected static $table_name = "data_sheet";
  protected static $db_columns = ['id', 'product_id', 'open_stock', 'new_stock', 'total_stock', 'sales_in_ltr', 'expected_stock', 'actual_stock', 'over_or_short', 'exp_sales_value', 'cash_submitted', 'total_sales', 'total_value', 'grand_total_value', 'company_id', 'branch_id', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $product_id;
  public $open_stock;
  public $new_stock;
  public $total_stock;
  public $sales_in_ltr;
  public $expected_stock;
  public $actual_stock;
  public $over_or_short;
  public $exp_sales_value;
  public $cash_submitted;
  public $total_sales;
  public $total_value;
  public $grand_total_value;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;
  public $name;
  public $tank;
  public $rate;

  const PRODUCTS = [1 => 'PMS', 2 => 'AGO', 3 => 'DPK'];
  const RATES = [1 => '162', 2 => '335', 3 => '345'];

  public function __construct($args = [])
  {
    // $this->id                   = $args['id'] ?? '';
    $this->product_id                 = $args['product_id'] ?? '';
    $this->open_stock           = $args['open_stock'] ?? '';
    $this->new_stock            = $args['new_stock'] ?? '';
    $this->total_stock          = $args['total_stock'] ?? '';
    $this->sales_in_ltr         = $args['sales_in_ltr'] ?? '';
    $this->expected_stock       = $args['expected_stock'] ?? '';
    $this->actual_stock         = $args['actual_stock'] ?? '';
    $this->over_or_short        = $args['over_or_short'] ?? '';
    $this->exp_sales_value      = $args['exp_sales_value'] ?? '';
    $this->cash_submitted       = $args['cash_submitted'] ?? '';
    $this->total_sales          = $args['total_sales'] ?? '';
    $this->total_value          = $args['total_value'] ?? '';
    $this->grand_total_value    = $args['grand_total_value'] ?? '';
    $this->company_id           = $args['company_id'] ?? '';
    $this->branch_id            = $args['branch_id'] ?? '';
    $this->created_by           = $args['created_by'] ?? '';
    $this->created_at           = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at           = $args['updated_at'] ?? '';
    $this->deleted              = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    return $this->errors;
  }

  public static function filter_by_date($dateFrom, $dateTo)
  {
    $sql = "SELECT ds.*, pr.name, pr.tank, pr.rate FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS pr ON ds.product_id = pr.id ";
    $sql .= "WHERE ds.created_at >='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND ds.created_at <='" . self::$database->escape_string($dateTo) . "'";
    $sql .= " AND (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";
    echo $sql;
    return static::find_by_sql($sql);
  }

  public static function get_data_sheets()
  {
    $sql = "SELECT ds.*, pr.name, pr.tank, pr.rate FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS pr ON ds.product_id = pr.id ";
    $sql .= "AND (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";
    return static::find_by_sql($sql);
  }


  // public static function find_by_company_id()
  // {
  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
  //   $sql .= "ORDER BY company_name ASC";
  //   return static::find_by_sql($sql);
  // }


  // public static function find_by_company_id($company_id)
  // {
  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= "WHERE company_id='" . self::$database_hr->escape_string($company_id) . "'";
  //   $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
  //   $sql .= "ORDER BY id ASC";
  //   $obj_array = static::find_by_sql($sql);
  //   if (!empty($obj_array)) {
  //     return array_shift($obj_array);
  //   } else {
  //     return false;
  //   }
  // }
}
