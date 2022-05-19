<?php
class StockCategory extends DatabaseObject
{
  protected static $table_name = "stock_category";
  protected static $db_columns = ['id','category_name','scale', 'unit','created_at','updated_at','created_by','deleted'];

    public $id;
    public $category_name;
    public $scale;
    public $unit;
    public $created_at ;
    public $updated_at;
    public $created_by;
    public $deleted;
 
    public $counts;

    public function __construct($args=[])
    {
        $this->category_name = $args['category_name'] ?? '';
        $this->scale = $args['scale'] ?? '';
        $this->unit = $args['unit'] ?? '';
        
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? '';
        $this->created_by = $args['created_by'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->category_name)) {
            $this->errors[] = "category cannot be blank.";
        } 
    }

    
    


   // public static function find_by_category($category)
   //  {
   //      $sql = "SELECT * FROM " . static::$table_name . " ";
   //      $sql .= "WHERE category ='" . self::$database->escape_string($category) . "'";
   //      $obj_array = static::find_by_sql($sql);
   //      return static::find_by_sql($sql);
   //  }
}
