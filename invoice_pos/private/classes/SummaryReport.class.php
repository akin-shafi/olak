<?php

class SummaryReport extends DatabaseObject {

  static protected $table_name = "summary_report";
  static protected $db_columns = ['id', 'ref_no', 'report_date', 'branch_id', 'cash_sales', 'expenses', 'sum_of_refund','complains', 'created_by', 'created_at', 'deleted'];
  
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
  public $deleted;

//   CREATE TABLE `summary_report` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `ref_no` int(50) NOT NULL,
//     `report_date` varchar(50) NOT NULL,
//     `branch_id` int(11) NOT NULL,
//     `company_id` int(50) NOT NULL,
//     `cash_sales` int(50) NOT NULL,
//     `expenses` int(50) NOT NULL,
//     `sum_of_refund` int(50) NOT NULL,
//     `complains` varchar(50) NOT NULL,
//     `created_by` int(50) NOT NULL,
//     `created_at` datetime NOT NULL DEFAULT current_timestamp(),
//     `updated_date` int(50) NOT NULL,
//     `deleted` int(20) NOT NULL,
//     PRIMARY KEY (`id`)
//    ) ;
// ALTER TABLE `summary_report` CHANGE `complains` `complains` TEXT NOT NULL;
// ALTER TABLE `summary_report` CHANGE `date_created` `report_date` VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
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
