<?php
class Product extends DatabaseObject
{
    protected static $table_name = "products";
    protected static $db_columns = ['id','ref_no', 'file', 'code', 'barcode_symbology', 'pname',  'type', 'category', 'quantity', 'sold_bottle', 'sold_shut','alert_quantity', 'product_tax', 'tax_method', 'sell_per_shut','cost', 'price', 'shut_price', 'no_of_shut', 'left_bottle', 'left_shut','vat', 'total_price', 'details','created_at', 'update_at', 'created_by', 'exception', 'deleted'];
  
  public $id;
  public $ref_no;
  public $file;
  public $code;
  public $barcode_symbology;
  public $pname;
  public $type;
  public $category;
  public $quantity;
  public $sold_bottle;
  public $sold_shut;
  public $alert_quantity;
  public $product_tax;
  public $tax_method;
  public $sell_per_shut; 
  public $cost;
  public $price;
  public $shut_price;
  public $vat;
  public $total_price;
  public $no_of_shut;
  public $left_bottle;
  public $left_shut;
  public $details;
  public $created_at;
  public $update_at;
  public $created_by;
  public $deleted;
  public $exception;
  public $counts;

    const PRODUCT_TYPE = [
      1 => 'Product',
      2 => 'combo',
      3 => 'service',  
    ];

    const PRODUCT_CATEGORY = [
      1 => 'Alcoholic Wine',
      2 => 'Non Alcoholic Wine',
      3 => 'Beer',
      4 => 'Soft Drink',
      5 => 'Juice',
      6 => 'Water',
     
    ];

    const BARCODE_SYMBOLOGY = [
      1 => 'Code25',
      2 => 'Code39',
      3 => 'Code128',
      4 => 'EAN8',
      5 => 'EAN13',
      6 => 'UPC-A',
      7 => 'UPC-E',
     
    ];
    const TAX_METHOD = [
      1 => 'Exclusive',
      2 => 'Inclusive',
    ];


    public function __construct($args=[])
    {
      $this->ref_no = $args['ref_no'] ?? '';
      $this->file = $args['file'] ?? 'bottles.jpg';
      $this->code = $args['code'] ?? '';
      $this->barcode_symbology = $args['barcode_symbology'] ?? '';
      $this->pname = $args['pname'] ?? '';
      $this->type = $args['type'] ?? '';
      $this->category = $args['category'] ?? '';
      $this->quantity = $args['quantity'] ?? 0;
      $this->sold_bottle = $args['sold_bottle'] ?? '';
      $this->sold_shut = $args['sold_shut'] ?? '';
      $this->alert_quantity = $args['alert_quantity'] ?? 0;
      $this->product_tax = $args['product_tax'] ?? '';
      $this->tax_method = $args['tax_method'] ?? '';
      $this->sell_per_shut = $args['sell_per_shut'] ?? 0;
      $this->cost = $args['cost'] ?? '';
      $this->price = $args['price'] ?? '';
      $this->shut_price = $args['shut_price'] ?? '';
      $this->no_of_shut = $args['no_of_shut'] ?? '';
      $this->left_bottle = $args['left_bottle'] ?? '';
      $this->left_shut = $args['left_shut'] ?? '';
      $this->vat = $args['vat'] ?? '';
      $this->total_price = $args['total_price'] ?? '';
      $this->details = $args['details'] ?? '';
      $this->created_at = $args['created_at'] ?? '';
      $this->update_at = $args['update_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? '';
      $this->exception = $args['exception'] ?? 0;
      $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->code)) {
            $this->errors[] = "code cannot be blank.";
        }elseif (!has_unique_product_code($this->code, $this->id ?? 0)) {
          $this->errors[] = "code already exist. Try another.";
        }

        if (is_blank($this->pname)) {
            $this->errors[] = "Product Name cannot be blank.";
        } 
        if (is_blank($this->type)) {
            $this->errors[] = "Product type cannot be blank.";
        } 
         if (is_blank($this->category)) {
            $this->errors[] = "Product category cannot be blank.";
        } 
        

        return $this->errors;
        
    }
 
    public static function find_by_category($category)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
        // $obj_array = static::find_by_sql($sql);
        // if(!empty($obj_array)) {
        //   return array_shift($obj_array);
        // } else {
        //   return false;
        // }
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= "ORDER BY id ASC";
        
         $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }
    public static function find_by_cat($category)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
       
    }

    //  public static function find_by_exception($exception)
    // {
    //     $sql = "SELECT * FROM " . static::$table_name . " ";
    //     $sql .= "WHERE exception='" . self::$database->escape_string($exception) . "'";
    //     $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    //     $sql .= "ORDER BY id ASC";
    //     $obj_array = static::find_by_sql($sql);
    //     return static::find_by_sql($sql);
       
    // }

    public static function find_by_product($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        // echo $sql;                          
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
    }
    public static function find_product($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE id='" . self::$database->escape_string($id) . "'";
        // echo $sql;                          
        $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

     public static function find_by_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
     public static function find_all_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        // $sql .= " AND exception = 0";
        $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);
        return $obj_array;
       
    }
    
     public function clearQty($id) {
      $sql = "UPDATE " . static::$table_name . " SET ";
      $sql .= "quantity = 0 ";
      $sql .= " WHERE id='" . self::$database->escape_string($id) . "' ";
      $sql .= "LIMIT 1";
      // echo $sql;
      $result = self::$database->query($sql);
      return $result;
    }

    
}
