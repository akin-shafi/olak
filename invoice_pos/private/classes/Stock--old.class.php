<?php
class Stock extends DatabaseObject
{
    protected static $table_name = "stocks";
    protected static $db_columns = ['id', 'product_id', 'quantity', 'created_by', 'created_at', 'deleted'];

    public $id;
    public $product_id;
    public $quantity;
    public $created_at;
    public $created_by;
    public $deleted;

    public $counts;

    public function __construct($args = [])
    {
        $this->product_id = $args['product_id'] ?? '';
        $this->quantity = $args['quantity'] ?? 0;

        $this->created_by = $args['created_by'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->product_id)) {
            $this->errors[] = "Product name cannot be blank.";
        }

        if (is_blank($this->quantity)) {
            $this->errors[] = "Quantity cannot be blank.";
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
