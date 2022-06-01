<?php
class Reservation extends DatabaseObject
{
    protected static $table_name = "reservations";
    protected static $db_columns = ['id','guest_id','name','start','end','room_id','status','reservation_type','adult','child','folio_no','room_price','night','created_by','created_at','updated_by','updated_at','deleted'];
  
    public $id;
    public $guest_id;
    public $name;
    public $start;
    public $end;
    public $room_id;
    public $status;
    public $reservation_type;
    public $adult;
    public $child;
    public $folio_no;
    public $room_price;
    public $night;
    public $created_by;
    public $created_at;
    public $updated_by;
    public $updated_at;
    public $deleted;
 
    public $counts;


      const RESERVATION_TYPE = [
        1 => 'Instant Booking',
        2 => 'Pre Booking'
      ];

      const TRANS_TYPE = [
        1 => 'Room Reservation',
        2 => 'Bar Service',
        3 => 'Restaurant Service',
        4 => 'Laundry Service',
      ];

      const PAYMENT_MODE = [
        1 => 'Cash Payment',
        2 => 'Wallet Account',
        3 => 'POS',
        4 => 'Transfer',
        5 => 'Company',
      ];
      const PAYMENT_OPTION = [
        1 => 'Full Payment',
        2 => 'Part Payment',
        // 3 => 'Postpaid',
        // 4 => 'Cash Payment'
      ];
      const RESERVATION_STATUS = [ //"New", "Checked-In", "Arrived", "CheckedOut"
        1 => 'New',
        2 => 'Confirmed',
        3 => 'Arrived',
        4 => 'Checked-Out'
      ];
      
    

    public function __construct($args=[])
    {
        $this->guest_id = $args['guest_id'] ?? '';
        $this->name = $args['name'] ?? '';
        $this->start = $args['start'] ?? '';
        $this->end = $args['end'] ?? '';
        $this->room_id = $args['room_id'] ?? '';
        $this->status = $args['status'] ?? 1; 
        $this->reservation_type = $args['reservation_type'] ?? '';
        $this->adult = $args['adult'] ?? '';
        $this->child = $args['child'] ?? '';
        $this->folio_no = $args['folio_no'] ?? '';
        $this->room_price = $args['room_price'] ?? '';
        $this->night = $args['night'] ?? '';
        $this->created_by = $args['created_by'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->updated_by = $args['updated_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        
        $this->deleted = $args['deleted'] ?? '';
    }

    
   protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->start)) {
            $this->errors[] = "Arrival date cannot be blank.";
        }
    }

     
    
    public static function find_by_name($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    } 

    public static function find_by_status($status)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE status ='" . self::$database->escape_string($status) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }

    static public function find_by_guest_id($guest_id)
      {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE guest_id='" . self::$database->escape_string($guest_id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }

      static public function find_single_transaction($guest_id, $trans_no)
      {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE guest_id='" . self::$database->escape_string($guest_id) . "'";
        $sql .= " AND trans_no='" . self::$database->escape_string($trans_no) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
      public static function find_by_date($options = [])
      {
        // $guest_id = $options['guest_id'] ?? false;
        // $customer_cat = $options['customer_cat'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;

          $sql = "SELECT * FROM " . static::$table_name . " ";
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
          $obj_array = static::find_by_sql($sql);

          return $obj_array;

          // $obj_array = static::find_by_sql($sql);
          // if (!empty($obj_array)) {
          //   return array_shift($obj_array);
          // } else {
          //   return false;
          // }

       }
      public static function sales($options = [])
      {
        $admin_id = $options['admin_id'] ?? false;
        $guest_id = $options['guest_id'] ?? false;
        // $customer_cat = $options['customer_cat'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $modeOfPayment = $options['modeOfPayment'] ?? false;
        $cash_total = $options['cash_total'] ?? false;

        if ($cash_total) { // this is to getting all transactions that the customer already paid for either by cash or bank excluding credit

          $sql = "SELECT COUNT(*), SUM(CASE WHEN modeOfPayment = 5 OR codType IN(1,3) THEN `amountPaid` ELSE `total_trans_charge` END) AS total_charges FROM " . static::$table_name . " ";
        } else { // this is to getting all total sales irrespective of the credit and COD
          $sql = "SELECT COUNT(*) AS counts, SUM(`total_trans_charge`) as total_charges FROM " . static::$table_name . " ";
        }

        if ($admin_id) { // FOR calculating sales person sales for the period
          $sql .= "WHERE `createdBy` = " . self::$database->escape_string($admin_id) . " ";
        } elseif ($guest_id) { // FOR calculating individual customers expenditure(total transactions sum) for the period
          $sql .= "WHERE `clientId` = " . self::$database->escape_string($guest_id) . " ";
          // $sql .= "AND `clientcat` = '" . self::$database->escape_string($customer_cat) . "' ";
        } else { // default if non of the above two condition is meet
          $sql .= "WHERE status IN(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16) ";
        }

        //********** this part is for duration*******//
        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(timeCreated) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(timeCreated) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(timeCreated) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(timeCreated) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(timeCreated) = '" . self::$database->escape_string($to) . "' ";
        }

        //****** this part is used to separate credit, bank and cash for sales person******/
        if ($modeOfPayment == 'credit') {
          $sql .= "AND `clientcat` = 'credit' ";
        } elseif ($modeOfPayment == 'bank') {
          $sql .= "AND `clientcat` != 'credit' AND modeOfPayment IN(2,3,4) ";
        } elseif ($modeOfPayment === 'cash') {
          $sql .= "AND `clientcat` != 'credit' AND modeOfPayment IN(1,5) ";
        }

        //****** this part is used to remove transaction tagged as customers COD only ******/
        if ($cash_total) {
          $sql .= " AND codType NOT IN(2) ";
        }

        //****** this part is to query sales per state ******/
       
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
        $guest_id = $options['guest_id'] ?? false;
        // $customer_cat = $options['customer_cat'] ?? false;
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $payment_method = $options['payment_method'] ?? false;
        $payment_category = $options['payment_category'] ?? false;
        $cash_total = $options['cash_total'] ?? false;

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
}
