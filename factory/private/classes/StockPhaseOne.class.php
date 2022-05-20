<?php
class StockPhaseOne extends DatabaseObject
{
  protected static $table_name = "stock_phase_one";
  protected static $db_columns = ['id', 'product_id', 'category_id', 'gauge_id', 'open_stock', 'production', 'return_inward', 'total_production', 'sales', 'imported', 'local', 'total_sales', 'closing_stock', 'company_id', 'branch_id', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $product_id;
  public $category_id;
  public $gauge_id;
  public $open_stock;
  public $production;
  public $return_inward;
  public $total_production;
  public $sales;
  public $imported;
  public $local;
  public $total_sales;
  public $closing_stock;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public $year;
  public $month;

  public $inflow;
  public $product_name;
  public $category_name;
  public $gauge_value;

  public function __construct($args = [])
  {
    $this->product_id       = $args['product_id'] ?? '';
    $this->category_id      = $args['category_id'] ?? '';
    $this->gauge_id         = $args['gauge_id'] ?? '';
    $this->open_stock       = $args['open_stock'] ?? '';
    $this->production       = $args['production'] ?? '';
    $this->return_inward    = $args['return_inward'] ?? '';
    $this->total_production = $args['total_production'] ?? '';
    $this->sales            = $args['sales'] ?? '';
    $this->imported         = $args['imported'] ?? '';
    $this->local            = $args['local'] ?? '';
    $this->total_sales      = $args['total_sales'] ?? '';
    $this->closing_stock    = $args['closing_stock'] ?? '';
    $this->company_id       = $args['company_id'] ?? '';
    $this->branch_id        = $args['branch_id'] ?? '';
    $this->created_by       = $args['created_by'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at       = $args['updated_at'] ?? '';
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    return $this->errors;
  }

  public static function find_by_metrics()
  {
    $sql = "SELECT year(created_at) AS year, month(created_at) AS month, SUM(total_sales) AS inflow  FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "GROUP BY year(created_at), month(created_at) ";
    $sql .= "ORDER BY year(created_at), month(created_at) ";

    return static::find_by_sql($sql);
  }

  public static function get_stock_sheet()
  {
    $sql = "SELECT SUM(total_production) AS total_production, SUM(total_sales) AS total_sales, SUM(return_inward) AS return_inward FROM " . static::$table_name . " ";
    $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function get_sheets($bId)
  {
    $date = date('Y');

    $sql = "SELECT product_id, SUM(total_production) AS total_production, SUM(total_sales) AS total_sales, SUM(return_inward) AS return_inward FROM " . static::$table_name . " ";

    $sql .= "WHERE created_at LIKE '%" . self::$database->escape_string($date) . "%'";
    $sql .= " AND branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $sql .= "GROUP BY product_id ";
    return static::find_by_sql($sql);
  }

  public static function get_top_selling_product($bId)
  {
    $date = date('Y');

    $sql = "SELECT SUM(ph.total_sales) AS total_sales, p.name AS product_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN products AS p ON ph.product_id = p.id ";


    $sql .= "WHERE ph.created_at LIKE '%" . self::$database->escape_string($date) . "%'";
    $sql .= " AND ph.branch_id='" . self::$database->escape_string($bId) . "'";

    $sql .= " AND (ph.deleted IS NULL OR ph.deleted = 0 OR ph.deleted = '') ";

    $sql .= "GROUP BY p.name ";

    return static::find_by_sql($sql);
  }

  public static function get_data_sheets($option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;

    $sql = "SELECT ph.*, cat.name AS category_name, ga.value AS gauge_value, pr.name AS product_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN categories AS cat ON ph.category_id = cat.id ";
    $sql .= "JOIN gauges AS ga ON ph.gauge_id = ga.id ";
    $sql .= "JOIN products AS pr ON ph.product_id = pr.id ";
    $sql .= "WHERE (ph.deleted IS NULL OR ph.deleted = 0 OR ph.deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ph.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ph.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    return static::find_by_sql($sql);
  }

  public static function group_by_category($from, $to, $branch)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "AND branch_id ='" . self::$database->escape_string($branch) . "'";
    $sql .= " AND created_at >='" . self::$database->escape_string($from) . "'";
    $sql .= " AND created_at <='" . self::$database->escape_string($to) . "'";
    $sql .= " GROUP BY category_id";

    return static::find_by_sql($sql);
  }

  public static function group_by_product($from, $to, $branch)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "AND branch_id ='" . self::$database->escape_string($branch) . "'";
    $sql .= " AND created_at >='" . self::$database->escape_string($from) . "'";
    $sql .= " AND created_at <='" . self::$database->escape_string($to) . "'";
    $sql .= " GROUP BY category_id, product_id";
    return static::find_by_sql($sql);
  }

  public static function find_by_category_id($categoryId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE category_id ='" . self::$database->escape_string($categoryId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }

  public static function find_by_product_id($productId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE product_id ='" . self::$database->escape_string($productId) . "'";
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

    $sql = "SELECT ph.*, SUM(ph.total_sales) AS inflow, pr.name AS product_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN products AS pr ON ph.product_id = pr.id ";
    $sql .= "WHERE ph.created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (ph.deleted IS NULL OR ph.deleted = 0 OR ph.deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ph.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ph.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " GROUP BY pr.name";

    return static::find_by_sql($sql);
  }

  /*
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
*/
}
