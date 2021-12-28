<?php
class Newsletter extends DatabaseObject
{

	protected static $table_name = "newsletter";
    protected static $db_columns = ['id','email','created_at','deleted'];

    public $id;
	public $email;
	public $created_at;
	public $deleted;
 
    public $counts;

    public function __construct($args=[])
    {

		$this->email 		= $args['email'] ?? '';
		$this->created_at 	= $args['created_at'] ?? date('Y-m-d H:i:s');
		$this->deleted 		= $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }elseif (!has_unique_email_newsletter($this->email, $this->id ?? 0)) {
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