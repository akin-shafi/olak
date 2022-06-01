<?php
class Settings extends DatabaseObject
{
    protected static $table_name = "settings";
    protected static $db_columns = ['id', 'login_type', 'sale_option','customer_name_format','auto_print', 'auto_process_delivery', 'delete_order', 'display_product', 'deleted'];
  
    public $id;
    public $login_type;
    public $sale_option;
    public $customer_name_format;
    public $auto_print;
    public $auto_process_delivery;
    public $delete_order;
    public $display_product;
    public $deleted;

    const LOGIN_TYPE = [
      1 => 'Email',
      2 => 'PIN', 
    ];

    const CUSTOMER_NAME_FORMAT = [
      1 => 'Tag Option',
      2 => 'Room Option', 
      3 => 'Name Entry', 
    ];

    const SALE_OPTION  = [
      1 => 'Sale to Zero',
      2 => 'Sale to Infinity',
    ];



    public function __construct($args=[])
    {
      $this->login_type = $args['login_type'] ?? '';
      $this->sale_option = $args['sale_option'] ?? '';
      $this->customer_name_format = $args['customer_name_format'] ?? '';
      $this->auto_print = $args['auto_print'] ?? 0;
      $this->auto_process_delivery = $args['auto_process_delivery'] ?? '';
      $this->delete_order = $args['delete_order'] ?? 0;
      $this->display_product = $args['display_product'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->login_type)) {
            $this->errors[] = "login type cannot be blank.";
        }
        

        return $this->errors;
    }


    // public static function find_by_product($id)
    // {
    //     $sql = "SELECT * FROM " . static::$table_name . " ";
    //     $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
    //     echo $sql;                          
    //     $obj_array = static::find_by_sql($sql);
    //     return static::find_by_sql($sql);
    // }

    


    
}
