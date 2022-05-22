<?php
class MaterialPhaseOne extends DatabaseObject
{
  protected static $table_name = "material_phase_one";
  protected static $db_columns = ['id', 'type', 'raw_category_id', 'raw_group_id', 'open_stock', 'inflow', 'total_stock', 'outflow', 'closing_stock', 'company_id', 'branch_id', 'remarks', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $type;
  public $raw_group_id;
  public $raw_category_id;
  public $open_stock;
  public $inflow;
  public $total_stock;
  public $outflow;
  public $closing_stock;
  public $company_id;
  public $branch_id;
  public $remarks;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public $year;
  public $month;

  public $product_name;
  public $category_name;

  const TYPE = [
    '1' => 'Net Weight',
    '2' => 'Number of coils',
  ];

  public function __construct($args = [])
  {
    $this->type             = $args['type'] ?? '';
    $this->raw_group_id     = $args['raw_group_id'] ?? '';
    $this->raw_category_id  = $args['raw_category_id'] ?? '';
    $this->open_stock       = $args['open_stock'] ?? '';
    $this->inflow           = $args['inflow'] ?? '';
    $this->total_stock      = $args['total_stock'] ?? '';
    $this->outflow          = $args['outflow'] ?? '';
    $this->closing_stock    = $args['closing_stock'] ?? '';
    $this->company_id       = $args['company_id'] ?? '';
    $this->branch_id        = $args['branch_id'] ?? '';
    $this->remarks          = $args['remarks'] ?? '';
    $this->created_by       = $args['created_by'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at       = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->open_stock)) {
      $this->errors[] = "Open stock is required.";
    }
    return $this->errors;
  }

  public static function find_by_metrics()
  {
    $sql = "SELECT year(created_at) AS year, month(created_at) AS month, SUM(inflow) AS inflow, SUM(total_stock) AS total_stock  FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "GROUP BY year(created_at), month(created_at) ";
    $sql .= "ORDER BY year(created_at), month(created_at) ";

    return static::find_by_sql($sql);
  }

  public static function get_stock_sheet()
  {
    $sql = "SELECT SUM(inflow) AS inflow, SUM(total_stock) AS total_stock, SUM(outflow) AS outflow FROM " . static::$table_name . " ";
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

    $sql = "SELECT *, SUM(inflow) AS inflow, SUM(total_stock) AS total_stock, SUM(outflow) AS outflow, SUM(closing_stock) AS closing_stock FROM " . static::$table_name . " ";

    $sql .= "WHERE created_at LIKE '%" . self::$database->escape_string($date) . "%'";
    $sql .= " AND branch_id='" . self::$database->escape_string($bId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $sql .= "GROUP BY raw_group_id ";

    return static::find_by_sql($sql);
  }

  public static function get_top_selling_product($bId)
  {
    $date = date('Y');

    $sql = "SELECT SUM(ph.inflow) AS inflow, SUM(ph.total_stock) AS total_stock, p.name AS product_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN products AS p ON ph.raw_group_id = p.id ";

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

    $sql = "SELECT ph.*, cat.name AS category_name, gr.name AS group_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN categories AS cat ON ph.raw_category_id = cat.id ";
    $sql .= "JOIN groups AS gr ON ph.raw_group_id = gr.id ";
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
    $sql .= " GROUP BY raw_category_id";

    return static::find_by_sql($sql);
  }

  public static function group_by_product($from, $to, $branch)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "AND branch_id ='" . self::$database->escape_string($branch) . "'";
    $sql .= " AND created_at >='" . self::$database->escape_string($from) . "'";
    $sql .= " AND created_at <='" . self::$database->escape_string($to) . "'";
    $sql .= " GROUP BY raw_category_id, raw_group_id";
    return static::find_by_sql($sql);
  }

  public static function find_by_category_id($categoryId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE raw_category_id ='" . self::$database->escape_string($categoryId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    return static::find_by_sql($sql);
  }

  public static function raw_group_id($productId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE raw_group_id ='" . self::$database->escape_string($productId) . "'";
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

    $sql = "SELECT ph.*, SUM(ph.total_stock) AS inflow, pr.name AS product_name FROM " . static::$table_name . " AS ph ";
    $sql .= "JOIN products AS pr ON ph.raw_group_id = pr.id ";
    $sql .= "WHERE ph.created_at ='" . self::$database->escape_string($dateFrom) . "'";
    $sql .= " AND (ph.deleted IS NULL OR ph.deleted = 0 OR ph.deleted = '') ";

    if (!empty($company) && !empty($branch)) :
      $sql .= " AND ph.company_id='" . self::$database->escape_string($company) . "'";
      $sql .= " AND ph.branch_id='" . self::$database->escape_string($branch) . "'";
    endif;

    $sql .= " GROUP BY pr.name";

    return static::find_by_sql($sql);
  }

  public static function find_by_branch_id($branchId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE branch_id ='" . self::$database->escape_string($branchId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
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
