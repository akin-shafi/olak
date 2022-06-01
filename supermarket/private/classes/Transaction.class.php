<?php
class Transaction extends DatabaseObject
{

  static protected $table_name = "transaction";
  static protected $db_columns = ['id', 'store_id', 'customer_id', 'trans_no',  'total_item', 'quantity_in_item',  'cost_of_item', 'processed_by', 'tax', 'discount', 'total_paid', 'balance', 'payment_method', 'note', 'payment_note',  'created_by', 'created_at', 'verification_status', 'verified_by', 'verified_at', 'deleted'];

  public $id;
  public $store_id;
  public $customer_id;
  public $trans_no;
  public $total_item;
  public $quantity_in_item;
  public $cost_of_item;
  public $processed_by;
  public $tax;
  public $discount;
  public $total_paid;
  public $balance;
  public $payment_method;
  public $note;
  public $payment_note;
  public $created_by;
  public $created_at;
  public $verification_status;
  public $verified_by;
  public $verified_at;
  public $deleted;

  public $counts;



  const PAYMENT_MODE = [
    "cash" => 'Cash',
    "credit_card" => 'POS',
    "transfer" => 'Transfer',
    "cheque" => 'Cheque',
    "gift_card" => 'Voucher',
    "credit" => 'Credit',
    "others" => 'Other',
  ];
  const PAYMENT_CATEGORY = [
    1 => 'Full Payment',
    2 => 'Part Payment',
    3 => 'Postpaid',
    // 4 => 'Cash Payment'
  ];

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
    $this->customer_id = $args['customer_id'] ?? '';
    $this->trans_no = $args['trans_no'] ?? '';
    $this->total_item = $args['total_item'] ?? '';
    $this->quantity_in_item = $args['quantity_in_item'] ?? '';
    $this->cost_of_item = $args['cost_of_item'] ?? '';
    $this->processed_by = $args['processed_by'] ?? 0;
    $this->tax = $args['tax'] ?? 0;
    $this->discount = $args['discount'] ?? 0;
    $this->total_paid = $args['total_paid'] ?? '';
    $this->balance = $args['balance'] ?? '';
    $this->payment_method = $args['payment_method'] ?? '';
    $this->note = $args['note'] ?? '';
    $this->payment_note = $args['payment_note'] ?? '';
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

    if (is_blank($this->total_paid)) {
      $this->errors[] = "Amount paid cannot be blank.";
    }
    if (is_blank($this->payment_method)) {
      $this->errors[] = "Payment method cannot be blank.";
    }
    return $this->errors;
  }

  static public function find_by_customer_id($customer_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($customer_id) . "'";
    $result = static::find_by_sql($sql);
    return $result;
  }


  static public function find_transaction($trans_no)
  {

    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_trans_number($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no ='" . self::$database->escape_string($trans_no) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_trans_no($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no ='" . self::$database->escape_string($trans_no) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= "ORDER BY id ASC";

    $obj_array = static::find_by_sql($sql);
    return static::find_by_sql($sql);
  }

  static public function find_by_trans($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no ='" . self::$database->escape_string($trans_no) . "'";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_verification($options = [])
  {
    $v_status = $options['v_status'] ?? false;
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE verification_status='" . self::$database->escape_string($v_status) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }
  public static function find_transaction_amount($trans_no)
  {
    $sql = "SELECT SUM(paid) FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    $sql .= " AND trans_no='" . self::$database->escape_string($trans_no) . "'";

    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
    // echo $sql;
  }
  public static function find_trans($options = [])
  {
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $charges = $options['charges'] ?? false;
    $created_by = $options['created_by'] ?? false;

    if ($charges == 'paid') {
      $sql = "SELECT SUM(paid) FROM " . static::$table_name . " ";
    } elseif ($charges == 'balance') {
      $sql = "SELECT SUM(balance) FROM " . static::$table_name . " ";
    } elseif ($charges == 'service_amount') {
      $sql = "SELECT SUM(service_amount) FROM " . static::$table_name . " ";
    } else {
      $sql = "SELECT * FROM " . static::$table_name . " ";
    }



    $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($created_by) {
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
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    // echo $sql;
    $obj_array = static::find_by_sql($sql);

    return $obj_array;

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }

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
    $sql .= " WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public static function number_of_sales($options = [])
  {

    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $created_by = $options['created_by'] ?? false;
    $sql = "SELECT COUNT(total_paid) FROM " . static::$table_name . " ";

    if ($payment_method == 'cash') {
      $sql .= "WHERE payment_method ='cash' ";
    } elseif ($payment_method == 'cheque') {
      $sql .= "WHERE payment_method ='cheque' ";
    } elseif ($payment_method == 'credit_card') {
      $sql .= "WHERE payment_method ='credit_card' ";
    } else {
      $sql .= "WHERE payment_method ='others' ";
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

    $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if (isset($created_by)) {
      $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
    }
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    // pre_r( $row);
    return array_shift($row);
  }

  public static function sum_of_sales($options = [])
  {

    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $created_by = $options['created_by'] ?? false;

    $sql = "SELECT SUM(total_paid) FROM " . static::$table_name . " ";

    if ($payment_method == 'cash') { //
      $sql .= "WHERE payment_method ='cash' ";
    } elseif ($payment_method == 'cheque') {
      $sql .= "WHERE payment_method ='cheque' ";
    } elseif ($payment_method == 'credit_card') {
      $sql .= "WHERE payment_method ='credit_card' ";
    } elseif ($payment_method == 'transfer') {
      $sql .= "WHERE payment_method ='transfer' ";
    } elseif ($payment_method == 'gift_card') {
      $sql .= "WHERE payment_method ='gift_card' ";
    } elseif ($payment_method == 'others') {
      $sql .= "WHERE payment_method ='others' ";
    } else {
      $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
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

    if (!empty($created_by)) {
      $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
    }


    $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    // echo $sql;
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    // pre_r( $row);
    return array_shift($row);
  }

  public static function sales($options = [])
  {
    $admin_id = $options['admin_id'] ?? false;
    $customer_id = $options['customer_id'] ?? false;
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
    } elseif ($customer_id) { // FOR calculating individual customers expenditure(total transactions sum) for the period
      $sql .= "WHERE `clientId` = " . self::$database->escape_string($customer_id) . " ";
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
    if ($payment_method == 'cash') {
      $sql .= "AND `payment_method` = 'cash' ";
    } elseif ($payment_method == 'credit_card') {
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
    $customer_id = $options['customer_id'] ?? false;
    // $customer_cat = $options['customer_cat'] ?? false;
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $payment_category = $options['payment_category'] ?? false;
    $cash_total = $options['cash_total'] ?? false;
    $states = $options['states'] ?? false;

    $sales_rep = $options['sales_rep'] ?? false;
    $category = $options['category'] ?? false;

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

  // Get all customer request
  public static function find_t_request($c_id, $options = [])
  {
    $status = $options['status'] ?? false;

    $sql = "SELECT COUNT(*) as counts, SUM(price) as price FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($c_id) . "'";
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
    // $sql .= "WHERE customer_id='" . self::$database->escape_string($c_id) . "'";
    // $result = static::find_by_sql($sql);
    // if (!empty($result)) {
    //   return array_shift($result);
    // } else {
    //   return false;
    // }
  }
}
