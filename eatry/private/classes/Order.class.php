<?php
class Order extends DatabaseObject
{
    protected static $table_name = "food_order";
    protected static $db_columns = ['id','order_by','product_name','product_quantity','product_price','total_price','created_at','updated_at','created_by','deleted'];

    public $id;
    public $order_by;
    public $product_name;
    public $product_quantity;
    public $product_price;
    public $total_price;

    public $created_at ;
    public $updated_at ;
    public $created_by;
    public $deleted;

 
    public $counts;


    public function __construct($args=[])
    {
        $this->order_by = $args['order_by'] ?? '';
        $this->product_name = $args['product_name'] ?? '';
        $this->product_quantity = $args['product_quantity'] ?? '';
        $this->product_price = $args['product_price'] ?? '';
        $this->total_price = $args['total_price'] ?? '';

        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->order_by)) {
            $this->errors[] = "Customer name cannot be blank.";
        } 

        if (is_blank($this->product_name)) {
            $this->errors[] = "Product name cannot be blank.";
        } 
        return $this->errors;
    }
 
    public static function find_by_username($username)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
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
