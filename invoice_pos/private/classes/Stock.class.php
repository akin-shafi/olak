<?php
class Stock extends DatabaseObject
{
    // KitchenRegisterDetails
  protected static $table_name = "stock";
   protected static $db_columns = ['id','ref_no','last_rec','exception','opened_at','closed_at','opened_by', 'closed_by', 'company_id', 'branch_id', 'deleted'];
     

    public $id;
    public $ref_no;
    public $last_rec;
    public $exception;
    public $opened_at;
    public $closed_at;
    public $opened_by;
    public $closed_by;
    public $company_id;
    public $branch_id;
    public $deleted;

 
    public $counts;

    public function __construct($args=[])
    {
        $this->ref_no = $args['ref_no'] ?? '';
        $this->last_rec = $args['last_rec'] ?? '';
        $this->exception = $args['exception'] ?? '';
        $this->opened_at = $args['opened_at'] ?? '';
        $this->closed_at = $args['closed_at'] ?? date('Y-m-d H:i:s');
        $this->opened_by = $args['opened_by'] ?? '';
        $this->closed_by = $args['closed_by'] ?? '';
        $this->company_id = $args['company_id'] ?? '';
        $this->branch_id = $args['branch_id'] ?? '';
        $this->deleted = $args['deleted'] ?? '';
        
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
