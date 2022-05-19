<?php
class Register extends DatabaseObject
{
    protected static $table_name = "register";
    protected static $db_columns = ['id', 'cash_in_hand', 'cash_sales', 'total_cash_submitted', 'cheque_sales','no_of_cheque', 'total_cheques_submitted','credit_card_sales','no_cc_slips','total_cc_slips_submitted', 'bank_transfer_sales','gift_card_sales','others', 'total_cash', 'total','note', 'verfication_status','expenses','open_time','close_time', 'created_by', 'deleted'];
    public $id;
    public $cash_in_hand;
    public $cash_sales;
    public $total_cash_submitted;
    public $cheque_sales;
    public $no_of_cheque;
    public $total_cheques_submitted;
    public $credit_card_sales;
    public $no_cc_slips;
    public $total_cc_slips_submitted;
    public $bank_transfer_sales;
    public $gift_card_sales;
    public $others;
    public $total_cash;
    public $total;
    public $note;
    public $verfication_status;
    public $expenses;
    public $open_time;
    public $close_time;
    public $created_by;
    public $deleted;
    public $counts;


    public function __construct($args=[])
    {
      $this->cash_in_hand = $args['cash_in_hand'] ?? 0;
      $this->cash_sales = $args['cash_sales'] ?? 0;
      $this->total_cash_submitted = $args['total_cash_submitted'] ?? 0;
      $this->cheque_sales = $args['cheque_sales'] ?? 0;
      $this->no_of_cheque = $args['no_of_cheque'] ?? 0;
      $this->total_cheques_submitted = $args['total_cheques_submitted'] ?? 0;
      $this->credit_card_sales = $args['credit_card_sales'] ?? 0;
      $this->no_cc_slips = $args['no_cc_slips'] ?? 0;
      $this->total_cc_slips_submitted = $args['total_cc_slips_submitted'] ?? 0;
      $this->bank_transfer_sales = $args['bank_transfer_sales'] ?? 0;
      $this->gift_card_sales = $args['gift_card_sales'] ?? 0;
      $this->others = $args['others'] ?? 0;
      $this->total_cash = $args['total_cash'] ?? 0;
      $this->total = $args['total'] ?? 0;
      $this->note = $args['note'] ?? '';
      $this->verfication_status = $args['verfication_status'] ?? 0;
      $this->expenses = $args['expenses'] ?? 0;
      $this->open_time = $args['open_time'] ?? date('Y-m-d H:i:s');
      $this->close_time = $args['close_time'] ?? '';
      $this->created_by = $args['created_by'] ?? '';
      $this->deleted = $args['deleted'] ?? 0;
    }

    
    protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->cash_in_hand)) {
            $this->errors[] = "Cash in Hand cannot be blank.";
        }

       
        return $this->errors;
    }



    public static function find_register_report($options=[])
    {
        $from = $options['from'] ?? false;
        $to = $options['to'] ?? false;
        $payment_method = $options['payment_method'] ?? false;
        $created_by = $options['created_by'] ?? false;
        

        // SELECT SUM(column_name)
        // FROM table_name
        // WHERE condition;
        $sql = "SELECT * FROM " . static::$table_name . " ";

       $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      
        if(!empty($created_by)){
          $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
        }

        if ($from && $to) {
          if ($from == $to) {
            $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($from) . "' ";
          } elseif ($from > $to) {
            $sql .= " AND DATE(open_time) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
          } elseif ($from < $to) {
            $sql .= " AND DATE(open_time) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
          }
        } elseif ($from && !$to) {
          $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($from) . "' ";
        } elseif (!$from && $to) {
          $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($to) . "' ";
        }

        

        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);
        // if (!empty($obj_array)) {
        //   return array_shift($obj_array);
        // } else {
        //   return false;
        // }
    }
    public static function find_by_time($options=[])
    {
        $open_time = $options['open_time'] ?? false;
        $created_by = $options['created_by'] ?? false;

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE DATE(open_time)='" . self::$database->escape_string($open_time) . "'";

        if(!empty($created_by)){
          $sql .= " AND created_by  ='" . self::$database->escape_string($created_by) . "'";
        }
        // if(isset($created_by)){
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
       // }
        // echo $sql;
         $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }
    public static function find_by_close_reg($close_time)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE DATE(close_time)='" . self::$database->escape_string($close_time) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // $sql .= "ORDER BY id ASC";
        echo $sql;
         $obj_array = static::find_by_sql($sql);
         // return static::find_by_sql($sql);
        if (!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }

    public static function find_all_by_date($open_time)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE DATE(open_time)='" . self::$database->escape_string($open_time) . "'";
         $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        // $sql .= "ORDER BY id ASC";
        
        $obj_array = static::find_by_sql($sql);
        return static::find_by_sql($sql);

    }

  public static function sum_of_sales($options=[]) 
  {
    
    $from = $options['from'] ?? false;
    $to = $options['to'] ?? false;
    $payment_method = $options['payment_method'] ?? false;
    $created_by = $options['created_by'] ?? false;
    
    $sql = "SELECT SUM(total) FROM " . static::$table_name . " ";

    if ($payment_method == 'cash') { //
      $sql .= "WHERE payment_method ='cash' ";
    }elseif ($payment_method == 'cheque') {
      $sql .= "WHERE payment_method ='cheque' ";
    }elseif ($payment_method == 'credit_card') {
      $sql .= "WHERE payment_method ='credit_card' ";
    }elseif ($payment_method == 'transfer') {
      $sql .= "WHERE payment_method ='transfer' ";
    }elseif ($payment_method == 'gift_card') {
      $sql .= "WHERE payment_method ='gift_card' ";
    }elseif($payment_method == 'others'){
      $sql .= "WHERE payment_method ='others' ";
    }else{
      $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    }
    
    if ($from && $to) {
      if ($from == $to) {
        $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($from) . "' ";
      } elseif ($from > $to) {
        $sql .= " AND DATE(open_time) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
      } elseif ($from < $to) {
        $sql .= " AND DATE(open_time) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
      }
    } elseif ($from && !$to) {
      $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($from) . "' ";
    } elseif (!$from && $to) {
      $sql .= " AND DATE(open_time) = '" . self::$database->escape_string($to) . "' ";
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

  public static function fetch_customer_data($from, $created_by, $exception)
  {
    
      // $created_by = $_GET['created_by'] ?? "";
      

    $currency = 'NGN';
    $cash_sales = Transaction::sum_of_sales(['from'=>$from,  'payment_method'=>'cash', 'created_by'=>$created_by]) ?? "0.00"; 
      $cheque_sales = Transaction::sum_of_sales(['from' => $from,  'payment_method'=>'cheque', 'created_by'=>$created_by]); 
      $cc_sales = Transaction::sum_of_sales(['from'=>$from,  'payment_method'=>'credit_card', 'created_by'=>$created_by]); 
      $gcard_sales = Transaction::sum_of_sales(['from'=>$from,  'payment_method'=>'gift_card', 'created_by'=>$created_by]); 
      $transfer_sales = Transaction::sum_of_sales(['from'=>$from,  'payment_method'=>'transfer', 'created_by'=>$created_by]); 
      $others = Transaction::sum_of_sales(['from'=>$from,  'payment_method'=>'others', 'created_by'=>$created_by]); 

      $total = $cash_sales + $cheque_sales + $cc_sales + $gcard_sales + $transfer_sales + $others;    
      
      $current_register = Register::find_by_time(['open_time' => $from, 'created_by' => $created_by]);
      // pre_r($current_register);
      $no_of_cheque = Transaction::number_of_sales(['from' => $from,  'payment_method'=>'cheque', 'created_by'=>$created_by]);
      $no_of_cc_sales = Transaction::number_of_sales(['from' => $from,  'payment_method'=>'credit_card', 'created_by'=>$created_by]);

  $product = Product::find_by_undeleted(['order' => 'ASC']);
     $company = CompanyDetails::find_by_id(1);
    $output = '
    <style>
      .table{
        width: 100%";
      }


    </style>
    <div style="text-align:center;">
                     
       <p style="text-align:center;">
          <strong>'.$company->company_name.'</strong><br>
          '.$company->address.'<br>'.$company->phone_no.'</p>
       <p></p>
    </div>
    <div class="col-lg-6">
    <div class="table-responsive">
      <h4>Sales order Report for '.date('D d M, Y', strtotime($from)).'</h4> ';
    

      $output .= ' 
      <table  class="table table-bordered" border="1">
        <tr>
          <td>Item</td>
                  <td>Price</td>
                  <td>Quantity</td>
                  <td>Total</td>
        </tr>
    ';
    foreach($product as $value)
    {
      if ($created_by != "") {
          $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'created_by'=>  $created_by,'from'=>  $from]);
        }else{
          $sales = Sales::find_all_by_product_id(['product_id' => $value->id,'from'=>  $from]);
        }
        
        $qty = $sales ?? 0;
        $subtotal = $qty * $value->price ?? 0;
        if ($value->ref_no != "" ) { 
          if ($qty != 0) {
          $output .= '
        
        <tr style="border-bottom: 1px solid #EEE;">
                 <td style="font-weight: bolder;">'.$value->pname.':</td>
                 <td>'.$value->price.'</td>
                 <td>'.$qty.'</td>

                 <td class="subtotal">'.$subtotal.'</td>
              </tr>
               
        ';
       }
      }
    }
    $output .= '
      <tr style="font-weight: bolder;">
             <td></td>
             <td></td>
             <td align="right">Grand Total</td>
             <td><span id="grand_total">0.00</span></td>
         </tr>
      ';
    $output .= '
        </table>
      </div>
    </div>
    ';

    $output .= '
    <div class="col-lg-6">
    <div class="table-responsive">
      <h4>Register Report for '.date('D d M, Y', strtotime($from)).'</h4> ';
    
      
      $output .= ' 
      <table class="table table-striped table-bordered">
        <tr>
          <td>Item</td>
          <td>Value</td>
        </tr>
    ';
    
        


     if (!empty($current_register)) {
      $output .= '
           <tr>
                 <td style="border-bottom: 1px solid #EEE;"><h4>Cash Sales:</h4></td>
                 <td style="text-align:right; border-bottom: 1px solid #EEE;"><h4>
                         <span>'.$currency.' '.number_format($cash_sales, 2).'</span>
                     </h4>
                 </td>
             </tr>

             <tr>
                 <td style="border-bottom: 1px solid #EEE;"><h4>POS Sales:</h4></td>
                 <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                         <span>'.$currency.' '.number_format($cc_sales, 2).'</span>
                     </h4>
                </td>
             </tr>

             <tr>
                 <td style="border-bottom: 1px solid #EEE;"><h4>Cheque Sales:</h4></td>
                 <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                         <span>'.$currency.' '.number_format($cheque_sales, 2).'</span>
                     </h4> 
                </td>
             </tr>
             <tr>
                 <td style="border-bottom: 1px solid #EEE;"><h4>Voucher:</h4></td>
                 <td style="text-align:right;border-bottom: 1px solid #EEE;"><h4>
                         <span>'.$currency.' '.number_format($gcard_sales, 2).'</span>
                     </h4>
                 </td>
                
             </tr>

             <tr>
                 <td style="border-bottom: 1px solid #DDD;"><h4>Bank Transfer:</h4></td>
                 <td style="text-align:right;border-bottom: 1px solid #DDD;"><h4>
                         <span>'.$currency.' '.number_format($transfer_sales, 2).'</span>
                     </h4>
                </td>
             </tr>

             <tr>
                 <td style="border-bottom: 1px solid #008d4c;"><h4>Others:</h4></td>
                 <td style="text-align:right;border-bottom: 1px solid #008d4c;"><h4>
                         <span>'.$currency.' '.number_format($others, 2).'</span>
                     </h4>
                
                </td>
             </tr>

             <tr>
                 <td width="300px;" style="font-weight:bold;"><h4>Total Sales:</h4></td>
                 <td width="200px;" style="font-weight:bold;text-align:right;"><h4>
                         <span>'.$currency.' '.number_format($total, 2).'</span>
                     </h4></td>
             </tr>

             <tr>
               <td width="300px;" style="font-weight:bold;">
                  <h4><strong>Total Cash</strong>:<small>(Cash in hand + Cash Sales)</small></h4>
               </td>
               <td style="text-align:right;">
                  <h4>
                       <span><strong>'. $currency.' '.number_format($current_register->cash_in_hand + $cash_sales, 2) .'</strong></span>
                      
                  </h4>
               </td>
           </tr>

           <tr>
               <td width="300px;" style="font-weight:bold;">
                  <h4><strong>Grand Total</strong>:<small>(Total Sales + cash in hand)</small></h4>
               </td>
               <td style="text-align:right;">
                  <h4>
                       <span><strong>'. $currency.' '.number_format( $total + $current_register->cash_in_hand, 2) .'</strong></span>
                  </h4>
               </td>
           </tr>

            
        ';
      }
      
    
    $output .= '
        </table>
      </div>
    </div>
    ';

    

  return $output;
}
    
}