<?php
class StockBin extends Stock
{
    // KitchenRegisterDetails
  protected static $table_name = "stock_bin";
  protected static $db_columns = ['id','ref_no','last_rec','exception','opened_at','closed_at','opened_by', 'closed_by','deleted'];
     

    public $id;
    public $ref_no;
    public $last_rec;
    public $exception;
    public $opened_at;
    public $closed_at;
    public $opened_by;
    public $closed_by;
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
        $this->deleted = $args['deleted'] ?? '';
        
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
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

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

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item_id='" . self::$database->escape_string($item_id) . "'";
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
