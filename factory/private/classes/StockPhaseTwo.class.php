<?php
class StockPhaseTwo extends DatabaseObject
{
  protected static $table_name = "stock_phase_two";
  protected static $db_columns = ['id', 'product_id', 'category_id', 'gauge_id', 'open_stock', 'production', 'transfer', 'total_production', 'sales', 'closing_stock', 'remarks', 'company_id', 'branch_id', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $product_id;
  public $category_id;
  public $gauge_id;
  public $open_stock;
  public $production;
  public $transfer;
  public $total_production;
  public $sales;
  public $closing_stock;
  public $remarks;
  public $company_id;
  public $branch_id;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $counts;

  public $year;
  public $month;

  public function __construct($args = [])
  {
    $this->product_id       = $args['product_id'] ?? '';
    $this->category_id      = $args['category_id'] ?? '';
    $this->gauge_id         = $args['gauge_id'] ?? '';
    $this->open_stock       = $args['open_stock'] ?? '';
    $this->production       = $args['production'] ?? '';
    $this->transfer         = $args['transfer'] ?? '';
    $this->total_production = $args['total_production'] ?? '';
    $this->sales            = $args['sales'] ?? '';
    $this->closing_stock    = $args['closing_stock'] ?? '';
    $this->remarks          = $args['remarks'] ?? '';
    $this->company_id       = $args['company_id'] ?? '';
    $this->branch_id        = $args['branch_id'] ?? '';
    $this->created_by       = $args['created_by'] ?? '';
    $this->created_at       = $args['created_at'] ?? date('Y-m-d');
    $this->updated_at       = $args['updated_at'] ?? '';
    $this->deleted          = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    return $this->errors;
  }
}
