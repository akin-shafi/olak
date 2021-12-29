<?php
class Branch extends DatabaseObject
{
	protected static $table_name = "branches";
    protected static $db_columns = ['id','company_id','address','city','state', 'established_in','created_at',  'deleted'];

    public $id;
    public $company_id;
	  public $address;
    public $city;
    public $state;
	  public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
      $this->company_id                 = $args['company_id'] ?? '';
      $this->address                    = $args['address'] ?? '';
  		$this->city 	                    = $args['city'] ?? '';
      $this->state                      = $args['state'] ?? '';
      $this->established_in             = $args['established_in'] ?? date('Y-m-d H:i:s');
  		$this->created_at 		            = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted                    = $args['deleted'] ?? '';
    }

    
    
    public static function find_by_employee_id($employee_id)
    {
        $sql = "SELECT * FROM " . static::$table_employee_id . " ";
        $sql .= "WHERE employee_id='" . self::$database->escape_string($employee_id) . "'";
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

// CREATE TABLE `branches` (
//  `id` int(11) NOT NULL AUTO_INCREMENT,
//  `company_id` varchar(50) NOT NULL,
//  `address` varchar(50) NOT NULL,
//  `city` varchar(50) NOT NULL,
//  `state` varchar(50) NOT NULL,
//  `established_in` varchar(50) NOT NULL,
//  `created_at` varchar(50) DEFAULT NULL,
//  `deleted` varchar(50) NOT NULL,
//  PRIMARY KEY (`id`)
// )