<?php
class Recipients extends DatabaseObject
{
    protected static $table_name = "recipients";
    protected static $db_columns = ['id', 'email', 'name', 'type','created_by','created_at','deleted'];


     public $id;
     public $email;
     public $name;
     public $type;
     public $created_by;
     public $created_at;
     public $deleted;
    

    public function __construct($args=[])
    {
        
        $this->email = $args['email'] ?? '';
        $this->name = $args['name'] ?? '';       
        $this->type = $args['type'] ?? '';       
        $this->created_by = $args['created_by'] ?? '';       
        $this->created_at = $args['created_at'] ?? '';       
        $this->deleted = $args['deleted'] ?? '';       
    }
    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }elseif (!has_unique_recipient_email($this->email, $this->id ?? 0)) {
          $this->errors[] = "Email already exist. Try another.";
        }

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
