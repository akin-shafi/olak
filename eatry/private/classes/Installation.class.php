<?php
class Installation extends DatabaseObject
{
    protected static $table_name = "installation";
    protected static $db_columns = ['id','code','hostname','deleted'];

    public $id;
    public $code;
    public $hostname;
    // public $color;
    public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
        $this->code = $args['code'] ?? '';
        $this->hostname = $args['hostname'] ?? '';
        // $this->color = $args['color'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->code)) {
            $this->errors[] = "Code cannot be blank.";
        } 
    }
 
    public static function find_code($code)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE code='" . self::$database->escape_string($code) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

   
}
