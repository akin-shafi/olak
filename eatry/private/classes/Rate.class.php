<?php
class Rate extends DatabaseObject
{
    protected static $table_name = "rate";
    protected static $db_columns = ['id','fixed_charge','price_per_km','priority','min_dist','rate_type','created_at','update_at','created_by','deleted'];

    public $id;
    public $fixed_charge;
    public $price_per_km;
    public $priority;
    public $min_dist; 
    public $rate_type; 

    public $created_at ;
    public $update_at ;
    public $created_by;
    public $deleted;

 
    public $counts;

    const RATE_TYPE = [
      1 => 'Distance Metrics',
      2 => 'Manual',
     
    ];

    public function __construct($args=[])
    {
        $this->fixed_charge = $args['fixed_charge'] ?? '';
        $this->price_per_km = $args['price_per_km'] ?? '';
        $this->priority = $args['priority'] ?? '';
        $this->min_dist = $args['min_dist'] ?? '';
        $this->rate_type = $args['rate_type'] ?? '';

        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->fixed_charge)) {
            $this->errors[] = "Fixed Charge cannot be blank.";
        } 
        if (is_blank($this->price_per_km)) {
            $this->errors[] = "Price per kilometer cannot be blank.";
        } 
         if (is_blank($this->min_dist)) {
            $this->errors[] = "Min distance cannot be blank.";
        } 
        if (is_blank($this->rate_type)) {
            $this->errors[] = "Type of rate cannot be blank.";
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

    
}
