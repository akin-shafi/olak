<?php
class RoomsCategory extends DatabaseObject
{
    protected static $table_name = "room_type";
    protected static $db_columns = ['id','category','price','created_at','update_on','created_by','deleted'];

    public $id;
    public $category;
    public $price;
    public $created_at ;
    public $update_on;
    public $created_by;
    public $deleted;

 
    public $counts;

    const ROOM_TYPE = [
      1 => 'Studio',
      2 => 'Suite / Executive Suite',
      3 => 'Mini Suite or Junior Suite',
      4 => 'President Suite / Presidential Suite',
      5 => 'Apartments / Room for Extended Stay',
      // 6 => 'Connecting rooms',
      // 7 => 'Murphy Room',
      // 8 => 'Accessible Room / Disabled Room',
      // 8 => 'Cabana',
     
    ];

    public function __construct($args=[])
    {
        $this->category = $args['category'] ?? '';
        $this->price = $args['price'] ?? '';
        
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->update_on = $args['update_on'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->category)) {
            $this->errors[] = "category cannot be blank.";
        } 

        if (is_blank($this->price)) {
            $this->errors[] = "Price cannot be blank.";
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
