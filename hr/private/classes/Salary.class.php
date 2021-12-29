<?php
class Salary extends DatabaseObject
{
	protected static $table_name = "salaries";
    protected static $db_columns = ['id','employee_id','actual_salary','current_salary','payment_status', 'created_at', 'deleted'];

    public $id;
    public $employee_id;
	  public $current_salary;
    public $payment_status;
    public $created_at;
	  public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
      $this->employee_id                 = $args['employee_id'] ?? '';
      $this->actual_salary          = $args['actual_salary'] ?? '';
  		$this->current_salary 	        = $args['current_salary'] ?? '';
      $this->payment_status           = $args['payment_status'] ?? '';

  		$this->created_at 		      = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted          = $args['deleted'] ?? '';
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