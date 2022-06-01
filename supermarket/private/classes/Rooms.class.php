<?php
class Rooms extends DatabaseObject
{
    protected static $table_name = "rooms";
    protected static $db_columns = ['id','name','capacity','status','price','created_at','updated_at','created_by','deleted'];

    public $id;
    public $name;
    public $capacity;
    public $status;
    public $price;
    public $created_at ;
    public $updated_at;
    public $created_by;
    public $deleted;

 
    public $counts;

    const ROOM_STATUS = [
        1 => 'Ready',
        2 => 'Cleanup',
        3 => 'Dirty',
        4 => 'Out of service',
      ];
    

    public function __construct($args=[])
    {
        $this->name = $args['name'] ?? '';
        $this->capacity = $args['capacity'] ?? '';
        $this->status = $args['status'] ?? ''; 
        $this->price = $args['price'] ?? '';
        
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    
   protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->name)) {
            $this->errors[] = "Room name cannot be blank.";
        } elseif (!has_unique_name($this->name, $this->id ?? 0)) {
          $this->errors[] = "Room already exist. Try another.";
        }

        if (is_blank($this->capacity)) {
            $this->errors[] = "capacity cannot be blank.";
        } 

        if (is_blank($this->price)) {
            $this->errors[] = "Price cannot be blank.";
        } 
    }

     
    
    public static function find_by_name($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    public static function find_by_status($status)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE status ='" . self::$database->escape_string($status) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }
}
