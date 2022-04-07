<?php
class Product extends DatabaseObject {
 
  static protected $table_name = "products";
  static protected $db_columns = ['id','customer_id','brand_id','product_id','product_price','product_stock','status','created_by','created_at','updated_at','deleted'];

  public $id;
  public $customer_id;
  public $brand_id;
  public $product_id;
  public $product_price;
  public $product_stock;
  public $status;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $category_name;
  public $brand_name;

  public function __construct($args=[]) {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->brand_id = $args['brand_id'] ?? '';
    $this->product_id = $args['product_id'] ?? '';
    $this->product_price = $args['product_price'] ?? '';
    $this->product_stock = $args['product_stock'] ?? '';
    $this->status = $args['status'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->customer_id)) {
      $this->errors[] = "Category cannot be blank.";
    } 

    if(is_blank($this->brand_id)) {
      $this->errors[] = "Brand cannot be blank.";
    } 

    if(is_blank($this->product_id)) {
      $this->errors[] = "Product name cannot be blank.";
    } 
     
    if(is_blank($this->product_price)) {
      $this->errors[] = "Product price cannot be blank.";
    }

    if(is_blank($this->product_stock)) {
      $this->errors[] = "Product quantity cannot be blank.";
    }

    return $this->errors;
  }
 
  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_products() {
    $sql = "SELECT p.id, p.product_id, c.category_name, b.brand_name, p.product_price, p.product_stock, p.created_at, p.status, p.deleted FROM product p, brand b, category c WHERE p.brand_id = b.id AND p.customer_id = c.id AND (p.deleted IS NULL OR p.deleted = 0 OR p.deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
  


  
}

?>
