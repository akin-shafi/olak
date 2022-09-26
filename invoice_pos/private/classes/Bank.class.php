<?php

class Bank extends DatabaseObject {

  static protected $table_name = "bank";
  static protected $db_columns = ['id', 'bank_name', 'account_name', 'account_number','company_id', 'branch_id','created_by','created_at', 'deleted'];
  
  public $id;
  public $bank_name;
  public $account_name;
  public $account_number;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $deleted;

  const BANK_NAME = [
    1 => 'Zenith Bank',
    2 => 'Access Bank',
    3 => 'Wema Bank',
    4 => 'Polaris Bank',
  ];
  
  public function __construct($args=[]) {
    $this->bank_name = $args['bank_name'] ?? '';
    $this->account_name = $args['account_name'] ?? '';
    $this->account_number = $args['account_number'] ?? '';
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->deleted = $args['deleted'] ?? NULL;
  }


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->bank_name)) {
      $this->errors[] = "Bank name is required";
    } 

     if(is_blank($this->account_number)) {
      $this->errors[] = "Account number is required";
    } 
    return $this->errors;
  }
 
  
  static public function find_by_company($company_id, $branch_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE company_id='" . self::$database->escape_string($company_id) . "'";
    $sql .= " AND branch_id='" . self::$database->escape_string($branch_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }



  



}
