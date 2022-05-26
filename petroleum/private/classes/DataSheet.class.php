<?php
class DataSheet extends DatabaseObject
{
  protected static $table_name = "data_sheet";
  protected static $db_columns = ['id', 'product_id', 'open_stock', 'new_stock', 'total_stock', 'sales_in_ltr', 'expected_stock', 'actual_stock', 'over_or_short', 'exp_sales_value', 'cash_submitted', 'total_sales', 'total_value', 'grand_total_value', 'company_id', 'branch_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted'];

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
  public $updated_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;
  public $name;
  public $tank;
  public $rate;
  public $sales_quantity;
  public $expected_sales;
  public $inflow;

  public $year;
  public $month;

  public $product_name;

  const PRODUCTS = [1 => 'PMS', 2 => 'AGO', 3 => 'DPK'];
  const RATES = [1 => '162', 2 => '335', 3 => '345'];

  public function __construct($args = [])
  {
    $this->product_id           = $args['product_id'] ?? '';
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
    $this->updated_by           = $args['updated_by'] ?? '';
    $this->created_at           = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at           = $args['updated_at'] ?? '';
    $this->deleted              = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    return $this->errors;
  }

  public static function filter_by_date($dateFrom, $dateTo, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT ds.*, pr.name, pr.tank, pr.rate FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS pr ON ds.product_id = pr.id ";
    $sql .= "WHERE ds.created_at >='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND ds.created_at <='" . self::$database->escape_string($dateTo) . "'";

    if (empty($company) && !empty($branch)) :
      $sql .= " AND ds.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ds.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ds.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " AND (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";
    $sql .= " ORDER BY pr.id, ds.created_at";

    echo $sql;
    return static::find_by_sql($sql);
  }

  public static function get_data_sheets($option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT ds.*, pr.name, pr.tank, pr.rate FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS pr ON ds.product_id = pr.id";
    $sql .= " WHERE (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ds.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ds.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    return static::find_by_sql($sql);
  }

  public static function find_by_product_id($productId, $option = [])
  {
    $date = $option['date'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE product_id='" . self::$database->escape_string($productId) . "'";

    if (isset($date)) {
      $sql .= " AND created_at LIKE'%" . self::$database->escape_string($date) . "%'";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_by_sheet_id($sheetId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE id='" . self::$database->escape_string($sheetId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function data_sheet_report($dateFrom, $option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT ds.*, SUM(ds.sales_in_ltr) AS sales_quantity, SUM(ds.exp_sales_value) AS expected_sales, SUM(ds.cash_submitted) AS inflow, pr.name, pr.tank, pr.rate FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS pr ON ds.product_id = pr.id ";
    $sql .= "WHERE ds.created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ds.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ds.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " GROUP BY pr.name";

    return static::find_by_sql($sql);
  }

  public static function find_by_metrics()
  {
    $sql = "SELECT year(created_at) AS year, month(created_at) AS month, SUM(cash_submitted) AS inflow  FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "GROUP BY year(created_at), month(created_at) ";
    $sql .= "ORDER BY year(created_at), month(created_at) ";

    return static::find_by_sql($sql);
  }


  public static function get_sheets($bId)
  {
    $date = date('Y');

    $sql = "SELECT product_id, SUM(total_stock) AS total_stock, SUM(sales_in_ltr) AS sales_in_ltr, SUM(expected_stock) AS expected_stock, SUM(actual_stock) AS actual_stock, SUM(over_or_short) AS over_or_short, SUM(exp_sales_value) AS exp_sales_value, SUM(cash_submitted) AS cash_submitted FROM " . static::$table_name . " ";

    $sql .= "WHERE created_at LIKE '%" . self::$database->escape_string($date) . "%'";
    $sql .= " AND branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $sql .= "GROUP BY product_id ";
    // $sql .= "ORDER BY product_id DESC";
    return static::find_by_sql($sql);
  }


  public static function get_stock_sheet()
  {
    $sql = "SELECT SUM(total_stock) AS total_stock, SUM(sales_in_ltr) AS sales_in_ltr, SUM(expected_stock) AS expected_stock, SUM(actual_stock) AS actual_stock, SUM(over_or_short) AS over_or_short, SUM(exp_sales_value) AS exp_sales_value, SUM(cash_submitted) AS cash_submitted FROM " . static::$table_name . " ";
    $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function get_top_selling_product($bId)
  {
    $date = date('Y');

    $sql = "SELECT SUM(ds.sales_in_ltr) AS sales_in_ltr, p.name AS product_name FROM " . static::$table_name . " AS ds ";
    $sql .= "JOIN products AS p ON ds.product_id = p.id ";


    $sql .= "WHERE ds.created_at LIKE '%" . self::$database->escape_string($date) . "%'";
    $sql .= " AND ds.branch_id='" . self::$database->escape_string($bId) . "'";

    $sql .= " AND (ds.deleted IS NULL OR ds.deleted = 0 OR ds.deleted = '') ";

    $sql .= "GROUP BY p.name ";
    // $sql .= "ORDER BY sales_in_ltr DESC";

    return static::find_by_sql($sql);
  }
}
