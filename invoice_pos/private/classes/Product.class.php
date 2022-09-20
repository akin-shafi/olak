<?php
class Product extends DatabaseObject
{
  protected static $table_name = "products";
  protected static $db_columns = ['id', 'branch_id', 'ref_no', 'file', 'code', 'barcode_symbology', 'pname', 'type', 'category', 'quantity', 'alert_quantity', 'product_tax', 'tax_method', 'cost', 'price', 'vat', 'total_price', 'details', 'created_at', 'update_at', 'created_by', 'exception', 'deleted'];

  public $id;
  public $branch_id;
  public $ref_no;
  public $file;
  public $code;
  public $barcode_symbology;
  public $pname;
  public $type;
  public $category;
  public $quantity;
  public $alert_quantity;
  public $product_tax;
  public $tax_method;
  public $cost;
  public $price;
  public $vat;
  public $total_price;
  public $details;
  public $created_at;
  public $update_at;
  public $created_by;
  public $exception;
  public $deleted;

  public $counts;

  const PRODUCT_TYPE = [
    1 => 'Product',
    2 => 'service',
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


  public function __construct($args = [])
  {
    $this->branch_id = $args['branch_id'] ?? '';
    $this->ref_no = $args['ref_no'] ?? '';
    $this->file = $args['file'] ?? '';
    $this->code = $args['code'] ?? '';
    $this->barcode_symbology = $args['barcode_symbology'] ?? '';
    $this->pname = $args['pname'] ?? '';
    $this->type = $args['type'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->quantity = $args['quantity'] ?? 0;
    $this->alert_quantity = $args['alert_quantity'] ?? 0;
    $this->product_tax = $args['product_tax'] ?? '';
    $this->tax_method = $args['tax_method'] ?? '';
    $this->cost = $args['cost'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->vat = $args['vat'] ?? '';
    $this->total_price = $args['total_price'] ?? '';
    $this->details = $args['details'] ?? '';
    $this->created_at = $args['created_at'] ?? '';
    $this->update_at = $args['update_at'] ?? '';
    $this->created_by = $args['created_by'] ?? date('Y-m-d H:i:s');
    $this->exception = $args['exception'] ?? 0;
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];
    if (is_blank($this->code)) {
      $this->errors[] = "code cannot be blank.";
    } elseif (!has_unique_product_code($this->code, $this->id ?? 0)) {
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

  public static function find_by_branch_id($options=[])
  {
    $branch_id = $options['branch_id'] ?? false;
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    
    if ($branch_id) {
      $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
    }
    echo $sql;
    return static::find_by_sql($sql);
  }

  public static function find_by_category($category)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";

    return static::find_by_sql($sql);
  }

  public static function find_by_cat($category)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
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
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  public function clearQty($id)
  {
    $sql = "UPDATE " . static::$table_name . " SET ";
    $sql .= "quantity = 0 ";
    $sql .= " WHERE id='" . self::$database->escape_string($id) . "' ";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }
}
