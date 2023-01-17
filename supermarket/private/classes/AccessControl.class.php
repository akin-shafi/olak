<?php
class AccessControl extends DatabaseObject
{
    protected static $table_name = "acccess_control";
    protected static $db_columns = ['id', 'user_id', 'stock_mgt', 'user_mgt', 'warehouse_mgt', 'purchase_mgt', 'product_mgt', 'shift_mgt', 'ledger_mgt', 'view_report', 'created_at','created_by','updated_at','updated_by', 'deleted']; 

    public $id;
    public $user_id;
    public $stock_mgt;
    public $user_mgt;
    public $product_mgt;
    public $shift_mgt;
    public $ledger_mgt;
    public $warehouse_mgt;
    public $purchase_mgt;
    public $view_report;
    
    public $created_at;
    public $created_by;
    public $deleted;
    public $counts;

    const VALUE = [
      1 => 'ON',
      0 => 'OFF', 
    ];

   
    public function __construct($args=[])
    {
      $this->user_id = $args['user_id'] ?? '';
      $this->stock_mgt = $args['stock_mgt'] ?? 0;
      $this->user_mgt = $args['user_mgt'] ?? 0;
      $this->product_mgt = $args['product_mgt'] ?? 0;
      $this->shift_mgt = $args['shift_mgt'] ?? 0;
      $this->ledger_mgt = $args['ledger_mgt'] ?? 0;
      $this->warehouse_mgt = $args['warehouse_mgt'] ?? 0;
      $this->purchase_mgt = $args['purchase_mgt'] ?? 0;
      $this->view_report = $args['view_report'] ?? 0;
      $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? 1;
      $this->updated_at = $args['updated_at'] ?? '';
      $this->updated_by = $args['updated_by'] ?? 1;
      $this->deleted = $args['deleted'] ?? 0;
    }
    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->user_id)) {
            $this->errors[] = "User name cannot be blank.";
        }elseif (!has_unique_user_id($this->user_id, $this->id ?? 0, "AccessControl")) {
          $this->errors[] = "Record already exist for this user. Just edit.";
        }

        if (is_blank($this->stock_mgt)) {
            $this->errors[] = "Stock mgt cannot be blank.";
        }
        if (is_blank($this->product_mgt)) {
            $this->errors[] = "product mgt cannot be blank.";
        }
        if (is_blank($this->user_mgt)) {
            $this->errors[] = "User mgt cannot be blank.";
        }
        if (is_blank($this->warehouse_mgt)) {
            $this->errors[] = "warehouse mgt cannot be blank.";
        }
        if (is_blank($this->purchase_mgt)) {
            $this->errors[] = "Procurement mgt cannot be blank.";
        }

        if (is_blank($this->view_report)) {
            $this->errors[] = "View report cannot be blank.";
        }
        return $this->errors;
    }
    public static function find_by_user_id($user_id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE user_id='" . self::$database->escape_string($user_id) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }

      
    public static function find_authorized($stock_mgt)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE stock_mgt='" . self::$database->escape_string($stock_mgt) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }

     public static function find_by_product($product)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE product='" . self::$database->escape_string($product) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    
    public static function find_warehouse_authorized($warehouse_mgt)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE warehouse_mgt='" . self::$database->escape_string($warehouse_mgt) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }


}
