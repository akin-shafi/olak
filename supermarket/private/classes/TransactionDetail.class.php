<?php
class TransactionDetail extends DatabaseObject
{

  static protected $table_name = "transaction_details";
  static protected $db_columns = ['id', 'trans_no', 'ref_no', 'total_paid', 'outstanding','payment_method',  'note', 'payment_note', 'created_by', 'company_id', 'branch_id', 'paid_at', 'created_at', 'deleted'];



  public $id;
  public $trans_no;
  public $ref_no;
  public $total_paid; 
  public $outstanding; 
  public $payment_method;  
  public $note; 
  public $payment_note; 
  public $created_by; 
  public $company_id; 
  public $branch_id; 
  public $paid_at; 
  public $created_at; 
  public $deleted;


  public function __construct($args = [])
  {
    $this->trans_no = $args['trans_no'] ?? '';
    $this->ref_no = $args['ref_no'] ?? '';
    $this->total_paid = $args['total_paid'] ?? '';
    $this->outstanding = $args['outstanding'] ?? '';
    $this->payment_method = $args['payment_method'] ?? '';
    $this->note = $args['note'] ?? '';
    $this->payment_note = $args['payment_note'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->paid_at = $args['paid_at'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? 0;
  }

  protected function validate()
  {
    $this->errors = [];

    // if (is_blank($this->payment_method)) {
    //   $this->errors[] = "Payment method is required.";
    // }


    return $this->errors;
  }

  static public function find_transaction($trans_no)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE trans_no='" . self::$database->escape_string($trans_no) . "'";
    $result = static::find_by_sql($sql);
    return $result;
  }

  static public function find_all_transaction($trans_no)
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

}