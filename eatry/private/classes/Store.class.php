<?php
class Store extends DatabaseObject
{
    protected static $table_name = "store";
    protected static $db_columns = ['id', 'name', 'category', 'image', 'created_at', 'created_by', 'deleted'];
    public $id;
    public $name;
    public $category;
    public $image;
    public $created_at;
    public $created_by;
    public $deleted;
    public $counts;

    const CATEGORY = [
      1 => 'Wine Store',
      2 => 'Lounge',
    ];
    public function __construct($args=[])
    {
      $this->name = $args['name'] ?? '';
      $this->category = $args['category'] ?? '';
      $this->image = $args['image'] ?? '';
      $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }
    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->name)) {
            $this->errors[] = "Name cannot be blank.";
        }

        if (is_blank($this->category)) {
            $this->errors[] = "category cannot be blank.";
        }
        // elseif (!has_unique_category($this->category, $this->id ?? 0)) {
        //   $this->errors[] = "Store already exist. Try another.";
        // }
        return $this->errors;
    }
    public static function find_by_category($category)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        
         $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }
    public static function find_by_product($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        echo $sql;                          
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }    
}
