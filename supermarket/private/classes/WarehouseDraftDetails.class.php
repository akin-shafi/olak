<?php 
class WarehouseDraftDetails extends CheckOutDetails {
  
  static protected $table_name = "warehouse_draft_details";
  static protected $db_columns = ['id', 'trans_no', 'product_id', 'product_quantity', 'unit_price', 'subtotal', 'created_by', 'created_at', 'updated_by', 'updated_at', 'returned', 'deleted'];

  public $id;
  public $trans_no;
  public $product_id;
  public $product_quantity;
  public $unit_price;
  public $subtotal;
  public $created_by;
  public $created_at;
  public $updated_by;
  public $updated_at;
  public $returned;
  public $deleted;
   



  public $counts;


  public function __construct($args=[]) {
    $this->trans_no               = $args['trans_no'] ?? '';
    $this->product_id           = $args['product_id'] ?? '';
    $this->product_quantity     = $args['product_quantity'] ?? '';
    $this->unit_price           = $args['unit_price'] ?? '';
    $this->subtotal             = $args['subtotal'] ?? '';
    $this->created_by           = $args['created_by'] ?? '';
    $this->created_at           = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_by           = $args['updated_by'] ?? '';
    $this->updated_at           = $args['updated_at'] ?? '';
    $this->returned             = $args['returned'] ?? '';
    $this->deleted              = $args['deleted'] ?? '';

  }





  
  
}

?>
