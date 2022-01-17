<?php
class AccessControl extends DatabaseObject
{

	protected static $table_name = "access_control";
    protected static $db_columns = ['id','admin_id','support','created_at', 'deleted'];

    public $id;
    public $admin_id;
	public $support;
    public $created_at;
	public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {

		$this->admin_id 		= $args['admin_id'] ?? '';
		$this->support 	        = $args['support'] ?? '';
		$this->created_at 		= $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted          = $args['deleted'] ?? '';
    }

    
    public static function find_by_admin_id($admin_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE admin_id='" . self::$database->escape_string($admin_id) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }


}