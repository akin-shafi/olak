<?php
class Sales extends DatabaseObject {
  
  static protected $table_name = "sales";
  static protected $db_columns = ['id','product_id', 'trans_no','product_quantity', 'unit_price', 'subtotal','created_by', 'created_at', 'updated_by', 'updated_at','returned', 'company_id', 'branch_id','deleted'];


  public $id;
  public $product_id;
  public $trans_no;

  public $product_quantity;
  public $unit_price;
  public $subtotal;
  public $created_by;
  public $created_at;

  public $updated_by;
  public $updated_at;
  public $returned;
  public $company_id;
  public $branch_id;
  public $deleted;

  public $counts;


  public function __construct($args=[]) {
    $this->product_id = $args['product_id'] ?? '';
    $this->trans_no = $args['trans_no'] ?? '';
    $this->product_quantity = $args['product_quantity'] ?? '';
    $this->unit_price = $args['unit_price'] ?? '';
    $this->subtotal = $args['subtotal'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');

    $this->updated_by = $args['updated_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->returned = $args['returned'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->deleted = $args['deleted'] ?? 0;
  }

  static public function find_by_product_id($product_id) {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE product_id='" . self::$database->escape_string($product_id) . "'";
      $obj_array = static::find_by_sql($sql);
      if(!empty($obj_array)) {
        return $obj_array;
      } else {
        return false;
      }
    }
  
  static public function find_all_by_product_id($options=[]) {
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $product_id = $options['product_id'] ?? false;
    $created_by = $options['created_by'] ?? false;
    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;

    $sql = "SELECT SUM(product_quantity) FROM " . static::$table_name . " ";
    $sql .= "WHERE product_id='" . self::$database->escape_string($product_id) . "'";

    if ($created_by) {
      $sql .= " AND created_by ='" . self::$database->escape_string($created_by) . "'";
    }
    if ($company_id) {
      $sql .= " AND company_id ='" . self::$database->escape_string($company_id) . "'";
    }
    if ($branch_id) {
      $sql .= " AND branch_id ='" . self::$database->escape_string($branch_id) . "'";
    }
    if ($from && $to) {
      if ($from == $to) {
        $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
      } elseif ($from > $to) {
        $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
      } elseif ($from < $to) {
        $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
      }
    } elseif ($from && !$to) {
      $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
    } elseif (!$from && $to) {
      $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
    }

    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    // echo $sql;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
  }
  static public function find_by_trans_no($trans_no) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no ='" . self::$database->escape_string($trans_no) . "'";
    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
  }

  static public function find_by_trans($trans_no) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  
  static public function find_all_transaction($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
     $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
     $sql .= "ORDER BY id ASC";
     $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
  }

  static public function find_item($options=[])
  {
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $product_id = $options['product_id'] ?? false;

    $company_id = $options['company_id'] ?? false;
    $branch_id = $options['branch_id'] ?? false;

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE product_id='" . self::$database->escape_string($product_id) . "'";
    
    if ($company_id) {
      $sql .= " AND company_id ='" . self::$database->escape_string($company_id) . "'";
    }
    if ($branch_id) {
      $sql .= " AND branch_id ='" . self::$database->escape_string($branch_id) . "'";
    }

    if ($from && $to) {
      if ($from == $to) {
        $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
      } elseif ($from > $to) {
        $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
      } elseif ($from < $to) {
        $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
      }
    } elseif ($from && !$to) {
      $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
    } elseif (!$from && $to) {
      $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
    }

     // echo $sql;
     $sql .= "ORDER BY id ASC";
     $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
  }

  

  static public  function void($trans_no) {
    $sales = Sales::find_by_trans_no($trans_no);
    foreach ($sales as $key => $value) {
     $product = Product::find_by_id($value->product_id);
     $sold_bottle = $product->sold_bottle - $value->product_quantity;
     $quantity = $product->quantity + $value->product_quantity;
     $data1 = [
         "sold_bottle"   => $sold_bottle,
         "quantity"    => $quantity
     ];
     $product->merge_attributes($data1);
     $updateProd = $product->save();
     // $updateProd = true;
    }
    if ($updateProd == true) {
     foreach ($sales as $key => $v) {
       $product = Product::find_by_id($v->product_id);
       $stockDetails = StockDetails::find_ref($product->ref_no);
       $sold_stock = $stockDetails->sold_stock - $v->product_quantity;
       $quantity = $stockDetails->qty_left + $v->product_quantity;
       $data2 = [
         "sold_stock" => $sold_stock,
           "qty_left"   => $quantity
       ];
       $stockDetails->merge_attributes($data2);
       // pre_r($stockDetails);
       // pre_r($data2);
       $updateStockD = $stockDetails->save();
       // $updateStockD = false;
     }
    }

    if ($updateStockD == true)  {
        foreach ($sales as  $val) {
            $eachSales = Sales::find_by_id($val->id);
            $args = [
             "deleted" => 1
            ];
            $eachSales->merge_attributes($args);
            $delSales = $eachSales->save();
            // $delSales = true;
        }
    }
    if ($delSales == true) {
      $transaction  = Transaction::find_transaction($trans_no);
      $deltrans = $transaction->deleted($transaction->id);
    }
    if ($deltrans == true) {
     return true;
    }
  }



  
}

?>
