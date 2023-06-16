<?php


class NewStock extends DatabaseObject
{

  protected static $table_name = "new_stock";
  protected static $db_columns = ['id', 'product_id', 'opening_stock', 'stock_in', 'return_inward', 'total_stock', 'out_flow', 'breakage', 'closing_stock', 'total_closing_stock', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted'];


  public $id;
  public $product_id;
  public $opening_stock;
  public $stock_in;
  public $return_inward;
  public $total_stock;
  public $out_flow;
  public $breakage;
  public $closing_stock;
  public $total_closing_stock;
  public $created_at;
  public $updated_at;
  public $created_by;
  public $updated_by;
  public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
        $this->product_id = $args['product_id'] ?? '';
        $this->opening_stock = $args['opening_stock'] ?? '';
        $this->stock_in = $args['stock_in'] ?? '';
        $this->return_inward = $args['return_inward'] ?? '';
        $this->total_stock = $args['total_stock'] ?? '';
        $this->out_flow = $args['out_flow'] ?? '';
        $this->breakage = $args['breakage'] ?? '';
        $this->closing_stock = $args['closing_stock'] ?? '';
        $this->total_closing_stock = $args['total_closing_stock'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? '';
        $this->created_by = $args['created_by'] ?? '';
        $this->updated_by = $args['updated_by'] ?? '';
        $this->deleted = $args['deleted'] ?? 0;
    }

    protected function validate()
    {
        $this->errors = [];

        // if (is_blank($this->ref_no)) {
        //     $this->errors[] = "Ref no cannot be blank.";
        // }
       
    }

    static public function find_by_opened_at($opened_at) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE  DATE(opened_at) = '" . self::$database->escape_string($opened_at) . "'";
        // $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        return $obj_array;
        
     }

    public static function find_by_ref($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        // $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function findRef($ref_no)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE ref_no='" . self::$database->escape_string($ref_no) . "'";
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        return $obj_array;
    }


    public static function find_in_register($options=[])
    {
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $ref_no = $options['ref_no'] ?? false;
        
        $opened_by = $options['opened_by'] ?? false;
        

        // SELECT SUM(column_name)
        // FROM table_name
        // WHERE condition;
        $sql = "SELECT * FROM " . static::$table_name . " ";

       $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      
        if($opened_by){
          $sql .= " AND opened_by  ='" . self::$database->escape_string($opened_by) . "'";
        }
        if($ref_no){
          $sql .= " AND ref_no  ='" . self::$database->escape_string($ref_no) . "'";
        }

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(opened_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(opened_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($to) . "' ";
        }

        

        
        // echo $sql;
        // $obj_array = static::find_by_sql($sql);
        // return static::find_by_sql($sql);

        // $obj_array = static::find_by_sql($sql);
        // return $obj_array;


         $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }

    public static function find_all_register($options=[])
    {
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $ref_no = $options['ref_no'] ?? false;
        
        $opened_by = $options['opened_by'] ?? false;
        

        // SELECT SUM(column_name)
        // FROM table_name
        // WHERE condition;
        $sql = "SELECT * FROM " . static::$table_name . " ";

       $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      
        if($opened_by){
          $sql .= " AND opened_by  ='" . self::$database->escape_string($opened_by) . "'";
        }
        if($ref_no){
          $sql .= " AND ref_no  ='" . self::$database->escape_string($ref_no) . "'";
        }

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(opened_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(opened_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(opened_at) = '" . self::$database->escape_string($to) . "' ";
        }

        
        // echo $sql;

        $obj_array = static::find_by_sql($sql);
        return $obj_array;


        // if (!empty($obj_array)) {
        //     return array_shift($obj_array);
        // } else {
        //     return false;
        // }
    }

    // UPDATE stock SET deleted = 1, closed_at='2021-08-19 21:37:00' WHERE id='3'
    static public function stocK_return_to_zero($options=[]) {
      
      $id = $options['id'] ?? false;
      $closed_at = $options['closed_at'] ?? false;
      $closed_by = $options['closed_by'] ?? false;
      $sql = "UPDATE " . static::$table_name . " SET ";
      $sql .= "deleted = 1 ";
      
      if ($closed_at) {
          $sql .= ", closed_at='" . self::$database->escape_string($closed_at) . "' ";
      }
      if ($closed_by) {
          $sql .= ", closed_by='" . self::$database->escape_string($closed_by) . "' ";
      }
      $sql .= " WHERE id='" . self::$database->escape_string($id) . "' ";

      
      // $sql .= "LIMIT 1;";
      // echo $sql;
      $result = self::$database->query($sql);
      return $result;
    }

    static public function find_by_closed_at($options=[]) {

        $order = $options['order'] ?? '';
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $last_rec = $options['last_rec'] ?? false;
        $exception = $options['exception'] ?? false;
        $limit = $options['limit'] ?? false;

        $sql = "SELECT * FROM " . static::$table_name . " ";
        //   $sql .= "WHERE deleted = 0 ";
        $sql .= " WHERE ( deleted = 1 ) ";

        if ($last_rec) {
          $sql .= " AND last_rec = '" . self::$database->escape_string($last_rec) . "' ";
        }
        if ($exception != '') {
             $sql .= " AND exception = '" . self::$database->escape_string($exception) . "' ";
        }

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(closed_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(closed_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($to) . "' ";
        }
   
        if ($order) {
          $sql .= " ORDER BY id " . self::$database->escape_string($order) . " ";
        }else{
          $sql .= " ORDER BY id DESC ";
        }

        if ($limit) {
          $sql .= "LIMIT ". self::$database->escape_string($limit) . " ";
        }
        // echo $sql;

        return static::find_by_sql($sql);
    }


    public static function find_by_item_id($options=[])
    {   
       $order = $options['order'] ?? '';
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $limit = $options['limit'] ?? false;
        $item_id = $options['item_id'] ?? false;

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

        if ($item_id) {
          $sql .= " AND item_id='" . self::$database->escape_string($item_id) . "'";
        }
        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(closed_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(closed_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(closed_at) = '" . self::$database->escape_string($to) . "' ";
        }

        if ($order) {
          $sql .= " ORDER BY id " . self::$database->escape_string($order) . " ";
        }else{
          $sql .= " ORDER BY id DESC ";
        }

        if ($limit) {
          $sql .= "LIMIT ". self::$database->escape_string($limit) . " ";
        }
        // echo $sql;

        return static::find_by_sql($sql);
    }
}


// CREATE TABLE `new_stock_details` (
//  `id` int(11) NOT NULL AUTO_INCREMENT,
//  `product_id` varchar(50) NOT NULL,
//  `opening_stock` varchar(50) NOT NULL,
//  `stock_in` varchar(50) NOT NULL,
//  `return_inward` varchar(50) NOT NULL,
//  `total_stock` varchar(50) NOT NULL,
//  `out_flow` varchar(50) NOT NULL,
//  `breakage` varchar(50) NOT NULL DEFAULT '0',
//  `closing_stock` varchar(50) NOT NULL DEFAULT '0',
//  `total_closing_stock` varchar(50) NOT NULL DEFAULT '0',
//  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
//  `updated_at` varchar(50) NOT NULL,
//  `created_by` varchar(50) NOT NULL,
//  `updated_by` varchar(50) NOT NULL,
//  `deleted` int(11) NOT NULL,
//  PRIMARY KEY (`id`)
// );