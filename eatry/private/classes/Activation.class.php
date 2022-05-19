<?php
class Activation extends DatabaseObjectLincense
{
    protected static $table_name = "activation";
    protected static $db_columns = ['id','company_id', 'plan','plan_type','create_date','expire_date', 'amount','created_by', 'product', 'flw_ref','transaction_id', 'tx_ref','order_no', 'activation_code','deleted', ];


     public $id;
     public $company_id;
     public $plan;
     public $plan_type;
     public $create_date;
     public $expire_date;
     public $amount;
     public $created_by;
     public $product;
     public $flw_ref;
     public $transaction_id;
     public $tx_ref;
     public $order_no;
     public $activation_code;

    public $deleted;

    public $counts;

    const PLAN = [
      1 => 'Free',
      2 => 'Standard',
      3 => 'Ultimate',
      4 => 'Premium',  
    ];
    const PLAN_TYPE = [
      1 => '14 Days',
      2 => 'Monthly',
      3 => 'Quarterly',
      4 => 'Yearly',  
    ];
    const SUPPORT = [
      1 => 'Yes',
      2 => 'No',
 
    ];

    public function __construct($args=[])
    {
        
        $this->company_id = $args['company_id'] ?? '';
        $this->plan = $args['plan'] ?? '';   
        $this->plan_type = $args['plan_type'] ?? '';   
        $this->create_date = $args['create_date'] ?? date('Y-m-d H:i:s'); 
        $this->expire_date = $args['expire_date'] ?? '';  
        $this->amount = $args['amount'] ?? '';
        $this->created_by = $args['created_by'] ?? '';
        $this->product = $args['product'] ?? '';
        $this->flw_ref = $args['flw_ref'] ?? '';
        $this->transaction_id = $args['transaction_id'] ?? '';
        $this->tx_ref = $args['tx_ref'] ?? '';
        $this->order_no = $args['order_no'] ?? '';
        $this->activation_code = $args['activation_code'] ?? '';
        
        $this->deleted = $args['deleted'] ?? '';      
    }

    
    public static function find_by_product($product)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE product='" . self::$database_lincense->escape_string($product) . "'";
        // echo $sql;
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    public static function FunctionName($value='')
    {
      $Today=date('y:m:d');

      // add 3 days to date
      $NewDate=Date('y:m:d', strtotime('+3 days'));

      // subtract 3 days from date
      $NewDate=Date('y:m:d', strtotime('-3 days'));

      // PHP returns last sunday's date
      $NewDate=Date('y:m:d', strtotime('Last Sunday'));

      // One week from last sunday
      $NewDate=Date('y:m:d', strtotime('+14 days Last Sunday'));
    }
    
     public static function dateDifference($start_date, $end_date)
    {
        // calulating the difference in timestamps 
        $diff = strtotime($end_date) - strtotime($start_date);
         
        // 1 day = 24 hours 
        // 24 * 60 * 60 = 86400 seconds
        return ceil(abs($diff / 86400));
    }

}
