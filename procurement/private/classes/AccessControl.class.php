<?php
class AccessControl extends DatabaseObject
{
  protected static $table_name = "access_control";
  protected static $db_columns = ['id', 'user_id', 'dashboard', 'request', 'settings', 'users_mgt', 'change_status', 'sales_mgt', 'expenses_mgt', 'report_mgt', 'created_by', 'created_at', 'deleted'];

  public $id;
  public $user_id;
  public $dashboard;
  public $request;
  public $settings;
  public $users_mgt;
  public $change_status;
  public $sales_mgt;
  public $expenses_mgt;
  public $report_mgt;

  public $created_by;
  public $created_at;
  public $deleted;

  public $counts;

  public function __construct($args = [])
  {
    $this->user_id      = $args['user_id'] ?? '';
    $this->dashboard    = $args['dashboard'] ?? '';
    $this->request    = $args['request'] ?? '';
    $this->settings    = $args['settings'] ?? '';
    $this->users_mgt    = $args['users_mgt'] ?? '';
    $this->change_status  = $args['change_status'] ?? '';
    $this->sales_mgt  = $args['sales_mgt'] ?? '';
    $this->expenses_mgt = $args['expenses_mgt'] ?? '';
    $this->report_mgt   = $args['report_mgt'] ?? '';

    $this->created_by   = $args['created_by'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  public static function find_by_user_id($uId)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($uId) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
