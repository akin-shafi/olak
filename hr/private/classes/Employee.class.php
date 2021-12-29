<?php
class Employee extends DatabaseObject
{

	protected static $table_name = "employees";
    protected static $db_columns = ['id','photo','employee_id','fullname','department','location','job_title','pbone','email','marital_status','dob','kin_name', 'kin_phone','highest_qualification','date_employeed','bank_name','bank_account','professional_body','current_salary','grade','step','created_at', 'deleted'];

    public $id;
    public $photo;
    public $employee_id;
    public $fullname;
    public $department;
    public $location;
    public $job_title;
    public $phone;
    public $email;
    public $marital_status;
    public $dob;
    public $kin_name;
	  public $kin_phone;
    public $highest_qualification;
    public $date_employeed;
    public $bank_name;
    public $bank_account;
    public $professional_body;
    public $current_salary;
    public $grade;
    public $step;
    public $created_at;
	  public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
      $this->photo                        = $args['photo'] ?? '';
      $this->employee_id                  = $args['employee_id'] ?? '';
      $this->fullname                     = $args['fullname'] ?? '';

      $this->comapany_id                  = $args['comapany_id'] ?? '';
      $this->branch_id                    = $args['branch_id'] ?? '';
      $this->department                   = $args['department'] ?? '';
      $this->job_title                    = $args['job_title'] ?? '';
      $this->phone                        = $args['phone'] ?? '';
      $this->email                        = $args['email'] ?? '';
      $this->marital_status               = $args['marital_status'] ?? '';
      $this->dob                          = $args['dob'] ?? '';
      $this->kin_name                     = $args['kin_name'] ?? '';
      $this->kin_phone                    = $args['kin_phone'] ?? '';
      $this->highest_qualification        = $args['highest_qualification'] ?? '';
      $this->date_employeed               = $args['date_employeed'] ?? '';
      $this->bank_name                    = $args['bank_name'] ?? '';
      $this->bank_account                 = $args['bank_account'] ?? '';
  		$this->professional_body 	          = $args['professional_body'] ?? '';
  		$this->created_at 		              = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted                      = $args['deleted'] ?? '';
    }

    
    public static function find_by_employee_id($name)
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