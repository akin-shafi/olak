<?php
class BusinessUser extends DatabaseObject
{

	protected static $table_name = "business_user";
    protected static $db_columns = ['id', 'company_name', 'firm_type', 'reg_status', 'rc_number', 'company_address', 'email', 'phone', 'created_at','deleted'];

    public $id;
    public $company_name;
    public $firm_type;
    public $reg_status;
    public $rc_number;
    public $company_address;
    public $email;
	public $phone;
	public $created_at;
	public $deleted;
 
    public $counts;

    

    public function __construct($args=[])
    {

        $this->company_name           = $args['company_name'] ?? '';
        $this->firm_type              = $args['firm_type'] ?? '';
        $this->reg_status               = $args['reg_status'] ?? '';
        $this->rc_number              = $args['rc_number'] ?? '';
        $this->company_address        = $args['company_address'] ?? '';
        $this->email                  = $args['email'] ?? '';
		$this->phone 		          = $args['phone'] ?? '';
		$this->created_at 	          = $args['created_at'] ?? date('Y-m-d H:i:s');
		$this->deleted 		          = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }elseif (!has_unique_email_business_user($this->email, $this->id ?? 0)) {
          $this->errors[] = "Email already exist. Try another.";
        }
        return $this->errors;
    }

    public static function find_by_email($email)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }



}