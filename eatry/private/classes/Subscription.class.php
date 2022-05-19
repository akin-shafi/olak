<?php
class Subscription extends DatabaseObjectLincense
{
    protected static $table_name = "subscription";
    protected static $db_columns = ['id','plan','amount','deleted', ];


    public $id;
    public $plan;
    public $amount;
    public $deleted;

    public $counts;

    const PLAN = [
      1 => 'Free',
      2 => 'Standard',
      3 => 'Ultimate',
      4 => 'Premium',  
    ];
    const PLAN_TYPE = [
      1 => '14 Days',
      2 => 'Monthly',
      3 => 'Quarterly',
      4 => 'Yearly',  
    ];

    public function __construct($args=[])
    {
        $this->id = $args[''] ?? '';
        $this->plan = $args[''] ?? '';  
        $this->amount = $args[''] ?? '';
        
        $this->deleted = $args['deleted'] ?? '';      
    }

 
    // public static function find_by_username($username)
    // {
    //     $sql = "SELECT * FROM " . static::$table_name . " ";
    //     $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    //     $obj_array = static::find_by_sql($sql);
    //     if (!empty($obj_array)) {
    //         return array_shift($obj_array);
    //     } else {
    //         return false;
    //     }
    // }

}
