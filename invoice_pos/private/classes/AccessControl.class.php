<?php
class AccessControl extends DatabaseObject
{
  protected static $table_name = "access_control";
  protected static $db_columns = ['id', 'user_id', 'dashboard', 'product_mgt', 'customer_mgt',  'wallet_mgt', 'stock_mgt', 'settings_mgt', 'sales_mgt', 'special_sales',  'add_sales', 'edit_sales', 'manage_sales', 'expenses_mgt', 'add_exp', 'edit_exp', 'delete_exp', 'report_mgt', 'access_control','can_approve', 'company_setup', 'user_mgt', 'compliance', 'filtering', 'process_waybill', 'created_by', 'created_at', 'deleted'];

  public $id;
  public $user_id;
  public $dashboard;
  public $product_mgt;
  public $customer_mgt;
  public $wallet_mgt;
  public $stock_mgt;
  public $settings_mgt;
  public $sales_mgt;
  public $special_sales;
  public $add_sales;
  public $edit_sales;
  public $manage_sales;
  public $expenses_mgt;
  public $add_exp;
  public $edit_exp;
  public $delete_exp;
  public $report_mgt;
  public $access_control;
  public $can_approve;
  public $company_setup;
  public $user_mgt;
  public $compliance;
  public $filtering;
  public $process_waybill;
  public $created_by;
  public $created_at;
  public $deleted;

  public $counts;

  const PERMISSION = ['dashboard', 'product_mgt', 'customer_mgt', 'wallet_mgt', 'stock_mgt', 'settings_mgt', 'sales_mgt', 'special_sales', 'add_sales', 'edit_sales', 'manage_sales', 'expenses_mgt', 'add_exp', 'edit_exp', 'delete_exp', 'report_mgt', 'access_control', 'can_approve', 'company_setup', 'user_mgt', 'compliance', 'filtering', 'process_waybill'];

  public function __construct($args = [])
  {
    $this->user_id        = $args['user_id'] ?? '';
    $this->dashboard      = $args['dashboard'] ?? 0;
    $this->product_mgt    = $args['product_mgt'] ?? 0;
    $this->customer_mgt   = $args['customer_mgt'] ?? 0;
    $this->wallet_mgt     = $args['wallet_mgt'] ?? 0;
    $this->stock_mgt      = $args['stock_mgt'] ?? 0;
    $this->settings_mgt   = $args['settings_mgt'] ?? 0;
    $this->sales_mgt      = $args['sales_mgt'] ?? 0;
    $this->special_sales  = $args['special_sales'] ?? 0;
    $this->add_sales      = $args['add_sales'] ?? 0;
    $this->edit_sales     = $args['edit_sales'] ?? 0;
    $this->manage_sales   = $args['manage_sales'] ?? 0;
    $this->expenses_mgt   = $args['expenses_mgt'] ?? 0;
    $this->add_exp        = $args['add_exp'] ?? 0;
    $this->edit_exp       = $args['edit_exp'] ?? 0;
    $this->delete_exp     = $args['delete_exp'] ?? 0;
    $this->report_mgt     = $args['report_mgt'] ?? 0;
    $this->access_control = $args['access_control'] ?? 0;
    $this->can_approve    = $args['can_approve'] ?? 0;
    $this->company_setup  = $args['company_setup'] ?? 0;
    $this->user_mgt       = $args['user_mgt'] ?? 0;
    $this->compliance     = $args['compliance'] ?? 0;
    $this->filtering      = $args['filtering'] ?? 0;
    $this->process_waybill      = $args['process_waybill'] ?? 0;

    $this->created_by   = $args['created_by'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->user_id)) {
      $this->errors[] = "Kindly select a staff";
    }

    return $this->errors;
  }

  public static function find_by_user_id($user_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($user_id) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
