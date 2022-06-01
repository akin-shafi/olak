<?php
class Schedule extends DatabaseObject
{
    protected static $table_name = "schedule";
    protected static $db_columns = ['id', 'user_id', 'shift_period', 'status', 'created_at','created_by','updated_at','updated_by', 'deleted'];
    public $id;
    public $user_id;
    public $shift_period;
    public $status;
    public $created_at;
    public $created_by;
    public $deleted;
    public $counts;

    const STATUS = [
      1 => 'ON',
      0 => 'OFF', 
    ];

   
    public function __construct($args=[])
    {
      $this->user_id = $args['user_id'] ?? '';
      $this->shift_period = $args['shift_period'] ?? 0;
      $this->status = $args['status'] ?? 0;
      $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? '';
      $this->updated_at = $args['updated_at'] ?? '';
      $this->updated_by = $args['updated_by'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }
    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->user_id)) {
            $this->errors[] = "User name cannot be blank.";
        }elseif (!has_unique_user_id($this->user_id, $this->id ?? 0, "Schedule")) {
          $this->errors[] = "Record already exist for this user. Just edit.";
        }
        return $this->errors;
    }
    public static function find_by_user_id($user_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id='" . self::$database->escape_string($user_id) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }
      
    public static function find_authorized($stock_mgt)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE stock_mgt='" . self::$database->escape_string($stock_mgt) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }


}
