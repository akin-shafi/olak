<?php
class CheckOut extends DatabaseObject
{

  static protected $table_name = "check_out";
  static protected $db_columns = ['id', 'store_id', 'receiver','trans_no',  'total_item', 'quantity_in_item',  'total_cost', 'note',  'created_by', 'created_at', 'verification_status', 'verified_by', 'verified_at'];

  public $id;
  public $store_id;
  public $receiver;
  public $trans_no;
  public $total_item;
  public $quantity_in_item;
  public $total_cost;
  
  public $note;
 
  public $created_by;
  public $created_at;
  public $verification_status; 
  public $verified_by;
  public $verified_at;
  public $deleted; 

   public $counts;



  const STATUS = [
    0 => 'New',
    1 => 'Accept',
    2 => 'Decline',
    3 => 'Start',
    4 => 'In-progress',
    5 => 'Not Available',
    6 => 'cancelled',
    7 => 'Returned',
    8 => 'Complete Task',
    9 => 'Delivered'
  ];
  

  public function __construct($args = [])
  {
    $this->store_id = $args['store_id'] ?? '';
    $this->receiver = $args['receiver'] ?? '';
    $this->trans_no = $args['trans_no'] ?? '';
    $this->total_item = $args['total_item'] ?? '';
    $this->quantity_in_item = $args['quantity_in_item'] ?? '';
    $this->total_cost = $args['total_cost'] ?? '';
    
    $this->note = $args['note'] ?? '';
    
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->verification_status = $args['verification_status'] ?? 0;
    $this->verified_by = $args['verified_by'] ?? 0;
    $this->verified_at = $args['verified_at'] ?? '';
    $this->deleted = $args['deleted'] ?? 0; 

  }


  protected function validate()
  {
    $this->errors = [];

    // if (is_blank($this->total_paid)) {
    //   $this->errors[] = "Amount paid cannot be blank.";
    // }
    // if (is_blank($this->payment_method)) {
    //   $this->errors[] = "Payment method cannot be blank.";
    // }
    // if (is_blank($this->receiver)) {
    //   $this->errors[] = "Client Name is required.";
    // }
    // if (is_blank($this->d_last_name)) {
    //   $this->errors[] = "Receiver's last name cannot be blank.";
    // }

    
    return $this->errors;
  }

  static public function find_by_receiver($receiver)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE receiver='" . self::$database->escape_string($receiver) . "'";
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
  
  
  static public function find_by_trans_no($trans_no) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no ='" . self::$database->escape_string($trans_no) . "'";
    // $obj_array = static::find_by_sql($sql);
    // if (!empty($obj_array)) {
    //   return array_shift($obj_array);
    // } else {
    //   return false;
    // }
     $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
     $sql .= "ORDER BY id ASC";
        
         $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
  }

  static public function find_verification($options =[])
  {
    $v_status = $options['v_status'] ?? false;
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE verification_status='" . self::$database->escape_string($v_status) . "'";
     $obj_array = static::find_by_sql($sql);
     return $obj_array;
  }
  public static function find_transaction_amount($trans_no)
    {
        $sql = "SELECT SUM(total_cost) FROM " . static::$table_name . " ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " AND trans_no='" . self::$database->escape_string($trans_no) . "'";

        $result_set = self::$database->query($sql);
        $row = $result_set->fetch_array();
        return array_shift($row);
        // echo $sql;
    }
  public static function find_trans($options = [])
      {
        // $guest_id = $options['guest_id'] ?? false;
        // $customer_cat = $options['customer_cat'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $charges = $options['charges'] ?? false;
        $created_by = $options['created_by'] ?? false;

          if ($charges == 'paid') {
            $sql = "SELECT SUM(paid) FROM " . static::$table_name . " ";
          }elseif ($charges == 'balance') {
            $sql = "SELECT SUM(balance) FROM " . static::$table_name . " ";
          }elseif ($charges == 'service_amount') {
            $sql = "SELECT SUM(service_amount) FROM " . static::$table_name . " ";
          }else{
            $sql = "SELECT * FROM " . static::$table_name . " ";
          }
          
           

          $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

          if($created_by){
              $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
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
          $obj_array = static::find_by_sql($sql);

          return $obj_array;

          $obj_array = static::find_by_sql($sql);
          if (!empty($obj_array)) {
            return array_shift($obj_array);
          } else {
            return false;
          }

          // $result_set = self::$database->query($sql);
          // $row = $result_set->fetch_array();
          // return array_shift($row);

    }
  static public function find_by_trans_type($trans_type)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_type='" . self::$database->escape_string($trans_type) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_single_transaction($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    // $sql .= "WHERE guest_id='" . self::$database->escape_string($guest_id) . "'";
    $sql .= " WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
  
 
  
  // public static function find_trans($options = [])
  //     {
  //       // $guest_id = $options['guest_id'] ?? false;
  //       // $customer_cat = $options['customer_cat'] ?? false;
  //       $from = $options['from'] ?? false;
  //       $to = $options['to'] ?? false;
  //       $charges = $options['charges'] ?? false;
  //       $created_by = $options['created_by'] ?? false;

  //         if ($charges == 'paid') {
  //           $sql = "SELECT SUM(paid) FROM " . static::$table_name . " ";
  //         }elseif ($charges == 'balance') {
  //           $sql = "SELECT SUM(balance) FROM " . static::$table_name . " ";
  //         }elseif ($charges == 'service_amount') {
  //           $sql = "SELECT SUM(service_amount) FROM " . static::$table_name . " ";
  //         }else{
  //           $sql = "SELECT * FROM " . static::$table_name . " ";
  //         }
          
           

  //         $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

  //         if($created_by){
  //             $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
  //           }
  //         if ($from && $to) {
  //           if ($from == $to) {
  //             $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
  //           } elseif ($from > $to) {
  //             $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
  //           } elseif ($from < $to) {
  //             $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
  //           }
  //         } elseif ($from && !$to) {
  //           $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
  //         } elseif (!$from && $to) {
  //           $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($to) . "' ";
  //         }

  //         // echo $sql;
  //         $obj_array = static::find_by_sql($sql);

  //         return $obj_array;

  //         $obj_array = static::find_by_sql($sql);
  //         if (!empty($obj_array)) {
  //           return array_shift($obj_array);
  //         } else {
  //           return false;
  //         }

  //         // $result_set = self::$database->query($sql);
  //         // $row = $result_set->fetch_array();
  //         // return array_shift($row);

  //   }
    
  public static function sum_of_sales($options=[]) 
  {
    
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $created_by = $options['created_by'] ?? false;
    
    $sql = "SELECT SUM(total_cost) FROM " . static::$table_name . " ";

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

    if(!empty($created_by)){
      $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
    }

     

    // echo $sql;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    // pre_r( $row);
    return array_shift($row);
    
  }

  public static function number_of_sales($options=[])
  {
    
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $created_by = $options['created_by'] ?? false;
    

    // SELECT SUM(column_name)
    // FROM table_name
    // WHERE condition;
    $sql = "SELECT COUNT(total_item) FROM " . static::$table_name . " ";

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

    

    if(isset($created_by)){
      $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
    }

    // echo $sql;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    // pre_r( $row);
    return array_shift($row);
    
  }

  public static function sales($options = [])
  {
    $admin_id = $options['admin_id'] ?? false;
    $receiver = $options['receiver'] ?? false;
    // $customer_cat = $options['customer_cat'] ?? false;
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $cash_total = $options['cash_total'] ?? false;
    $states = $options['states'] ?? false;

    if ($cash_total) { // this is to getting all transactions that the customer already paid for either by cash or bank excluding credit

      $sql = "SELECT COUNT(*), SUM(CASE WHEN payment_method = 5 OR codType IN(1,3) THEN `amountPaid` ELSE `total_trans_charge` END) AS total_charges FROM " . static::$table_name . " ";
    } else { // this is to getting all total sales irrespective of the credit and COD
      $sql = "SELECT COUNT(*) AS counts, SUM(`total_trans_charge`) as total_charges FROM " . static::$table_name . " ";
    }

    if ($admin_id) { // FOR calculating sales person sales for the period
      $sql .= "WHERE `createdBy` = " . self::$database->escape_string($admin_id) . " ";
    } elseif ($receiver) { // FOR calculating individual customers expenditure(total transactions sum) for the period
      $sql .= "WHERE `clientId` = " . self::$database->escape_string($receiver) . " ";
      // $sql .= "AND `clientcat` = '" . self::$database->escape_string($customer_cat) . "' ";
    } else { // default if non of the above two condition is meet
      $sql .= "WHERE status IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16) ";
    }

    //********** this part is for duration*******//
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

    //****** this part is used to separate credit, bank and cash for sales person******/
    if ($payment_method == 'cash') {
      $sql .= "AND `payment_method` = 'cash' ";
    }elseif ($payment_method == 'credit_card') {
      $sql .= "AND `payment_method` = 'credit_card' ";
    } elseif ($payment_method == 'bank') {
      $sql .= "AND `payment_method` != 'credit' AND payment_method IN(2,3,4) ";
    } elseif ($payment_method === 'cash') {
      $sql .= "AND `payment_method` != 'credit' AND payment_method IN(1,5) ";
    }

    //****** this part is used to remove transaction tagged as customers COD only ******/
    if ($cash_total) {
      $sql .= " AND codType NOT IN(2) ";
    }

    //****** this part is to query sales per state ******/
    if ($states) {
      $sql .= "OR `AssociatedRouteOriginating`  IN('" . self::sanitize_states($states) . "' ) ";
    }

    //****** this part is remove deleted rows from the calculation ******/
    $sql .= "  AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    // $sql .= "ORDER BY `transaction`.`id` DESC ";
    // echo $sql;
    $obj_array = static::find_by_sql($sql);
    // return $obj_array;
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_sales($options = [])
  {
    $admin_id = $options['admin_id'] ?? false;
    $receiver = $options['receiver'] ?? false;
    // $customer_cat = $options['customer_cat'] ?? false;
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $payment_category = $options['payment_category'] ?? false;
    $cash_total = $options['cash_total'] ?? false;
    $states = $options['states'] ?? false;

    $sales_rep = $options['sales_rep'] ?? false;
    $category = $options['category'] ?? false;


    // $sql = "SELECT * FROM transactions WHERE created_by = $sales_rep ";
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE created_by ='" . self::$database->escape_string($admin_id) . "'";

    if ($from == $to) {
      $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
    } elseif ($from > $to) {
      $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
    } elseif ($from < $to) {
      $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
    }

    if ($category) {
      $sql .= "  AND payment_method='" . self::$database->escape_string($category) . "'";
    }

    $sql .= "  AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    // echo $sql;
    $obj_array = static::find_by_sql($sql);

    return $obj_array;
  }

  static public function find_by_rec($options=[]) {

        $order = $options['order'] ?? '';
        $from = $options['from'] ?? '';
        $to = $options['to'] ?? '';

        $sql = "SELECT * FROM " . static::$table_name . " ";
        //   $sql .= "WHERE deleted = 0 ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

        if ($from == $to) {
          $sql .= " AND DATE(created_at) = '" . self::$database->escape_string($from) . "' ";
        } elseif ($from > $to) {
          $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
        } elseif ($from < $to) {
          $sql .= " AND DATE(created_at) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
        }
        
        if ($order) {
          $sql .= " ORDER BY id " . self::$database->escape_string($order) . " ";
        }else{
          $sql .= " ORDER BY id DESC ";
        }
        // echo $sql;

        return static::find_by_sql($sql);
    }

  // Get all customer request
  public static function find_t_request($c_id, $options = [])
  {
    $status = $options['status'] ?? false;

    $sql = "SELECT COUNT(*) as counts, SUM(price) as price FROM " . static::$table_name . " ";
    $sql .= "WHERE receiver='" . self::$database->escape_string($c_id) . "'";
    if ($status) {
      $sql .= " AND status='" . self::$database->escape_string($status) . "'";
    }
    $result = static::find_by_sql($sql);
    if (!empty($result)) {
      return array_shift($result);
    } else {
      return false;
    }

    // $sql = "SELECT COUNT(*) as counts FROM " . static::$table_name . " ";
    // $sql .= "WHERE receiver='" . self::$database->escape_string($c_id) . "'";
    // $result = static::find_by_sql($sql);
    // if (!empty($result)) {
    //   return array_shift($result);
    // } else {
    //   return false;
    // }
  }
}
