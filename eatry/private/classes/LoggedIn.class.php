<?php
class LoggedIn extends DatabaseObject
{
    protected static $table_name = "logged_in";
    protected static $db_columns = ['id','status', 'user_id','time_log_in', 'time_log_out'];


     public $id;
     public $status;
     public $user_id;
     public $time_log_in;
     public $time_log_out;

     public $counts;

    const STATUS = [
      0 => 'OFFLINE',
      1 => 'ONLINE',
        
    ];

    public function __construct($args=[])
    {
         
        $this->status = $args['status'] ?? '';   
        $this->user_id = $args['user_id'] ?? '';   
        $this->time_log_in = $args['time_log_in'] ?? date('Y-m-d H:i:s');    
        $this->time_log_out = $args['time_log_out'] ?? '';    
    }

    
    public static function find_user_by_status($options=[])
    {	
    	$user_id = $options['user_id'] ?? false;
    	$status = $options['status'] ?? false;
    	$time_log_in = $options['time_log_in'] ?? false; 

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id='" . self::$database->escape_string($user_id) . "'";

        if ($status) {
        	$sql .= " AND status='" . self::$database->escape_string($status) . "'";
        }
        if ($time_log_in) {
        	$sql .= " AND DATE(time_log_in) = '" . self::$database->escape_string($time_log_in) . "'";
        }
        
        
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function find_all_by_status($options=[])
    {	
    	$status = $options['status'] ?? false;
    	$time_log_in = $options['time_log_in'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE status='" . self::$database->escape_string($status) . "'";
        if ($time_log_in) {
        	$sql .= " AND DATE(time_log_in) = '" . self::$database->escape_string($time_log_in) . "'";
        }
        $obj_array = static::find_by_sql($sql);
        return $obj_array;
        
    }
    public static function find_by_day($options=[])
    {   
        $time_log_in = $options['time_log_in'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE DATE(time_log_in)='" . self::$database->escape_string($time_log_in) . "'";
        $obj_array = static::find_by_sql($sql);
        return $obj_array;
        
    }

}
