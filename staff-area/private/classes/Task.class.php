<?php
class Task extends DatabaseObject
{

    protected static $table_name = "task";
    protected static $db_columns = ['id','admin_id','request_id', 'status', 'notary_no', 'reason', 'created_at', 'created_by','updated_at','updated_by', 'date_completed', 'deleted'];

    public $id;
    public $admin_id;
    public $request_id;
    public $status;
    public $notary_no;
    public $reason;
    public $created_at;
    public $created_by;
    public $updated_at;
    public $updated_by;
    public $date_completed;
    public $deleted;
 
    public $counts;

    public function __construct($args=[])
    {

        $this->admin_id         = $args['admin_id'] ?? '';
        $this->request_id       = $args['request_id'] ?? '';
        $this->status           = $args['status'] ?? '';
        $this->notary_no        = $args['notary_no'] ?? '';
        $this->reason           = $args['reason'] ?? '';
        $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->created_by       = $args['created_by'] ?? 'Not Set';
        $this->updated_at       = $args['updated_at'] ?? '';
        $this->updated_by       = $args['updated_by'] ?? 'Not Set';
        $this->date_completed   = $args['date_completed'] ?? 'Not Set';
        $this->deleted          = $args['deleted'] ?? '';
    }

    

    public static function find_by_admin_id($admin_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE admin_id='" . self::$database->escape_string($admin_id) . "'";
        $obj_array = static::find_by_sql($sql);
        $sql .= " ORDER BY id DESC ";
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }
    public static function find_by_request_id($request_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE request_id='" . self::$database->escape_string($request_id) . "'";
        $obj_array = static::find_by_sql($sql);
        // if (!empty($obj_array)) {
        //     return array_shift($obj_array);
        // } else {
        //     return false;
        // }

        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

    public static function find_by_request($request_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE request_id='" . self::$database->escape_string($request_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }

        // if (!empty($obj_array)) {
        //     return $obj_array;
        // } else {
        //     return false;
        // }
    }
    



}