<?php
class Designation extends DatabaseObject
{

	protected static $table_name = "designation";
    protected static $db_columns = ['id','name','department','created_at', 'deleted'];

    public $id;
    public $name;
	  public $department;
    public $created_at;
	  public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
      $this->name                 = $args['name'] ?? '';
  		$this->department 	        = $args['department'] ?? '';
  		$this->created_at 		      = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted          = $args['deleted'] ?? '';
    }

    
    public static function find_by_name($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
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