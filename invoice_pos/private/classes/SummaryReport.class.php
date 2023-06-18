<?php

class SummaryReport extends DatabaseObject {

  static protected $table_name = "summary_report";
  static protected $db_columns = ['id', 'ref_no', 'report_date', 'branch_id', 'cash_sales', 'expenses', 'sum_of_refund','complains', 'created_by', 'created_at', 'updated_date', 'deleted'];
  
  public $id;

  public $ref_no;
  public $report_date;
  public $branch_id;
  public $company_id;
  public $cash_sales;
  public $expenses;
  public $sum_of_refund;
  public $complains;
  public $created_by;
  public $created_at;
  public $updated_date;
  
  public $deleted;
  public function __construct($args=[]) {
    $this->ref_no           = $args['ref_no'] ?? '';
    $this->report_date     = $args['report_date'] ?? '';
    $this->branch_id        = $args['branch_id'] ?? 0;
    $this->company_id       = $args['company_id'] ?? 0;
    $this->cash_sales       = $args['cash_sales'] ?? 0;
    $this->expenses         = $args['expenses'] ?? 0;
    $this->sum_of_refund    = $args['sum_of_refund'] ?? 0;
    $this->complains        = $args['complains'] ?? '';
    $this->created_by       = $args['created_by'] ?? 0;
    $this->created_at       = $args['created_at'] ?? date('Y-m-d H:m:s');
    $this->updated_date       = $args['updated_date'] ?? '';
    $this->deleted          = $args['deleted'] ?? NULL;
  }


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->report_date)) {
      $this->errors[] = "Date name is required";
    }

    if(is_blank($this->branch_id)) {
      $this->errors[] = "Branch is required";
    } 

    if(is_blank($this->cash_sales)) {
      $this->errors[] = "Cash Sales is required";
    } 

    if(is_blank($this->expenses)) {
        $this->errors[] = "Expenses Sales is required";
    }
    
    if(is_blank($this->sum_of_refund)) {
        $this->errors[] = "Sum of Refund is required";
    } 

    return $this->errors;
  }
 
  
  static public function find_by_date($options=[])
  {

    $report_date = $options['report_date'] ?? false;
    $branch_id = $options['branch_id'] ?? false;
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
    if($report_date){
        $sql .= " AND DATE(report_date) = '" . self::$database->escape_string($report_date) . "' ";
    }
    if($branch_id){
        $sql .= " AND branch_id = '" . self::$database->escape_string($branch_id) . "' ";
    }
    // echo $sql;
    // return static::find_by_sql($sql);
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }



}
