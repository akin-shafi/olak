<?php
class WarehouseItemCategory extends DatabaseObject
{
    protected static $table_name = "warehouse_items_categories";
    protected static $db_columns = ['id','category','created_at','created_by','deleted'];

    public $id;
    public $category;
    public $created_at ;
    public $created_by;
    public $deleted;

 
    public $counts;

    const PRODUCT_CATEGORY = [
      1 => 'Alcoholic Wine',
      2 => 'Non Alcoholic Wine',
      3 => 'Beer',
      4 => 'Soft Drink',
      5 => 'Juice',
      6 => 'Water',
     
    ];

    public function __construct($args=[])
    {
        $this->category = $args['category'] ?? '';
        
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->category)) {
            $this->errors[] = "category cannot be blank.";
        } 

        // if (is_blank($this->price)) {
        //     $this->errors[] = "Price cannot be blank.";
        // } 
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
