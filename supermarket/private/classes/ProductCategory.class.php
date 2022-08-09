<?php
class ProductCategory extends DatabaseObject
{
    protected static $table_name = "categories";
    protected static $db_columns = ['id','category','created_at','created_by', 'exception', 'company_id', 'branch_id','deleted'];

    public $id;
    public $category;
    public $created_at ;
    public $created_by;
    public $exception;
    public $company_id;
    public $branch_id;
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
    const VALUE = [
      1 => 'TRUE',
      0 => 'FALSE',
     
    ];

    public function __construct($args=[])
    {
        $this->category = $args['category'] ?? '';
        
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->created_by = $args['created_by'] ?? '';
        $this->exception = $args['exception'] ?? 0;
        $this->company_id = $args['company_id'] ?? 0;
        $this->branch_id = $args['branch_id'] ?? 0;
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

    public static function find_by_company($options=[])
    {
        $company_id = $options['company_id'] ?? false;
        $branch_id = $options['branch_id'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE company_id='" . self::$database->escape_string($company_id) . "'";
        $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
     
        $sql .= " ORDER BY id DESC ";
        echo $sql;

        $obj_array = static::find_by_sql($sql);
        return $obj_array;
    }
}