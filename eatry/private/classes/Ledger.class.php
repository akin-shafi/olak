<?php
class Ledger extends DatabaseObject
{

  static protected $table_name = "ledger";
  static protected $db_columns = ['id','guest_id','trans_no','cost_of_service','total_paid','outstanding_bal','created_by','created_at','updated_at','deleted'];


   public $id;
   public $guest_id;
   public $trans_no;
   public $cost_of_service;
   public $total_paid;
   public $outstanding_bal;
   public $created_by; 
   public $created_at; 
   public $updated_at; 
   public $deleted; 

   public $counts;

   
  public function __construct($args = [])
  {
    $this->guest_id = $args['guest_id'] ?? '';
    $this->trans_no = $args['trans_no'] ?? '';
    $this->cost_of_service = $args['cost_of_service'] ?? '';
    $this->total_paid = $args['total_paid'] ?? '';
    $this->outstanding_bal = $args['outstanding_bal'] ?? '';
    $this->created_by = $args['created_by'] ?? ''; 
    $this->created_at = $args['created_at'] ?? ''; 
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s'); 
    $this->deleted = $args['deleted'] ?? 0; 

  }


  protected function validate()
  {
    // $this->errors = [];

    // if (is_blank($this->d_first_name)) {
    //   $this->errors[] = "Receiver's first name cannot be blank.";
    // }
    // if (is_blank($this->customer_id)) {
    //   $this->errors[] = "Client Name is required.";
    // }
    // if (is_blank($this->d_last_name)) {
    //   $this->errors[] = "Receiver's last name cannot be blank.";
    // }

    
    // return $this->errors;
  }

  static public function find_by_guest_id($guest_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE guest_id='" . self::$database->escape_string($guest_id) . "'";
    $result = static::find_by_sql($sql);
     return $result;
  }
  static public function find_transaction($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function find_total_trans($options = [])
      {
        // $guest_id = $options['guest_id'] ?? false;
        // $customer_cat = $options['customer_cat'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $charges = $options['charges'] ?? false;

          if ($charges == 'total_paid') {
            $sql = "SELECT SUM(total_paid) FROM " . static::$table_name . " ";
          }elseif ($charges == 'outstanding_bal') {
            $sql = "SELECT SUM(outstanding_bal) FROM " . static::$table_name . " ";
          }elseif ($charges == 'cost_of_service') {
            $sql = "SELECT SUM(cost_of_service) FROM " . static::$table_name . " ";
          }
          
          $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

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
          // $obj_array = static::find_by_sql($sql);

          // return $obj_array;

          // $obj_array = static::find_by_sql($sql);
          // if (!empty($obj_array)) {
          //   return array_shift($obj_array);
          // } else {
          //   return false;
          // }

          $result_set = self::$database->query($sql);
          $row = $result_set->fetch_array();
          return array_shift($row);

    }
}
