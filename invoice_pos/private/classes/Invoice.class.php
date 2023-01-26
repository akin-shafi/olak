<?php

class Invoice extends DatabaseObject
{

  static protected $table_name = 'invoice';
  static protected $db_columns = ['id', 'transid', 'service_type', 'quantity', 'status', 'unit_cost', 'rebate_value', 'amount', 'company_id', 'branch_id', 'created_at', 'created_by', 'updated_at', 'deleted'];

  public $id;
  public $transid;
  public $service_type;
  public $quantity;
  public $status;
  public $unit_cost;
  public $rebate_value;
  // public $vat;
  public $amount;
  public $company_id;
  public $branch_id;
  public $created_at;
  public $created_by;
  public $updated_at;

  public $sum_of_quantity;
  public $grand_total;

  public $deleted;



  public function __construct($args = [])
  {

    $this->transid = $args['transid'] ?? '';
    $this->service_type = $args['service_type'] ?? '';
    $this->quantity = $args['quantity'] ?? '';
    $this->status = $args['status'] ?? 0;
    $this->unit_cost = $args['unit_cost'] ?? '';
    $this->rebate_value = $args['rebate_value'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
    $this->created_by = $args['created_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? '';
    $this->deleted = $args['deleted'] ?? '';
    // $this->updatedTime = $args['updatedTime'] ?? date("Y-m-d H:i:s");

    // Caution: allows private/protected properties to be set
    // foreach($args as $k => $v) {
    //   if(property_exists($this, $k)) {
    //     $this->$k = $v;
    //   }
    // }
  }


  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->service_type)) {
      $this->errors[] = "Kindly Select a Service Type.";
    }
    // if(is_blank($this->vendor)) {
    //   $this->errors[] = "Kindly Select a Vendor.";
    // }
    // if(is_blank($this->request)) {
    //   $this->errors[] = "Kindly Select a Request.";
    // }
    if (is_blank($this->quantity)) {
      $this->errors[] = "Quantity cannot be blank.";
    }

    if (is_blank($this->unit_cost)) {
      $this->errors[] = "Unit-Cost cannot be blank.";
    }

    if (is_blank($this->amount)) {
      $this->errors[] = "Amount cannot be blank.";
    }

    return $this->errors;
  }

  static public function find_all_by_transid($invoiceNum)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE transid = " . self::$database->escape_string($invoiceNum) . " ";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    // echo $sql;
    // return static::find_by_sql($sql);

    // echo $sql;
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
    
  }

  static public function find_by_transid($invoiceNum)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE transid = " . self::$database->escape_string($invoiceNum) . " ";
    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    // echo $sql;
    return static::find_by_sql($sql);
  }

  static public function find_all_invoices($options=[]) {

    $order = $options['order'] ?? '';
    // $company_id = $options['company_id'] ?? '';
    // $branch_id = $options['branch_id'] ?? '';

    $sql = "SELECT * FROM " . static::$table_name . " ";
    //   $sql .= "WHERE deleted = 0 ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($order) {
      $sql .= " ORDER BY id " . self::$database->escape_string($order) . " ";
    }else{
      $sql .= " ORDER BY id DESC ";
    }
    // echo $sql;

    return static::find_by_sql($sql);
  }


   public static function get_total_sales($option = [])
  {
    $company = $option['company'] ?? false;
    $branch = $option['branch'] ?? false;
    $from = $option['from'] ?? false;
    $to = $option['to'] ?? false;

    $sql = "SELECT SUM(amount) FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    if ($company) :
      $sql .= " AND company_id='" . self::$database->escape_string($company) . "'";
    endif;

    if ($branch) {
      $sql .= " AND branch_id='" . self::$database->escape_string($branch) . "'";
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
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
  }
  

  static public function find_all_by_service_type($options=[]) {
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $service_type = $options['service_type'] ?? false;
    $status = $options['status'] ?? false;
    $branch_id = $options['branch_id'] ?? false;
    $created_at = $options['created_at'] ?? false;

    $sql = "SELECT COUNT(*) AS counts, SUM(quantity) AS sum_of_quantity, SUM(amount) AS grand_total, SUM(unit_cost) AS unit_cost, SUM(rebate_value) AS rebate_value FROM " . static::$table_name . " ";

    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    if ($service_type) {
      $sql .= " AND service_type='" . self::$database->escape_string($service_type) . "'";
    }

    if ($status) {
      $sql .= " AND status ='" . self::$database->escape_string($status) . "'";
    }

    if ($branch_id) {
      $sql .= " AND branch_id ='" . self::$database->escape_string($branch_id) . "'";
    }

    if ($created_at) {
      $sql .= " AND created_at ='" . self::$database->escape_string($created_at) . "'";
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
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function sum_of_rebate_value($options=[])
  {
    $transid = $options['transid'] ?? false;
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;

    $sql = "SELECT SUM(rebate_value) FROM " . static::$table_name . " ";
    $sql .= "WHERE transid='" . self::$database->escape_string($transid) . "'";
    $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";

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
    $result_set = self::$database->query($sql);
    $row = $result_set->fetch_array();
    return array_shift($row);
  }
}
