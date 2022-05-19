<?php
class WarehouseDraft extends CheckOut
{

  static protected $table_name = "warehouse_draft";
  static protected $db_columns = ['id', 'store_id', 'receiver','trans_no',  'total_item', 'quantity_in_item',  'total_cost', 'note',  'created_by', 'created_at', 'verification_status', 'verified_by', 'verified_at'];

  public $id;
  public $store_id;
  public $receiver;
  public $trans_no;
  public $total_item;
  public $quantity_in_item;
  public $total_cost;
  
  public $note;
 
  public $created_by;
  public $created_at;
  public $verification_status; 
  public $verified_by;
  public $verified_at;
  public $deleted; 

   public $counts;

  

  public function __construct($args = [])
  {
    $this->store_id = $args['store_id'] ?? '';
    $this->receiver = $args['receiver'] ?? '';
    $this->trans_no = $args['trans_no'] ?? '';
    $this->total_item = $args['total_item'] ?? '';
    $this->quantity_in_item = $args['quantity_in_item'] ?? '';
    $this->total_cost = $args['total_cost'] ?? '';
    
    $this->note = $args['note'] ?? '';
    
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->verification_status = $args['verification_status'] ?? 0;
    $this->verified_by = $args['verified_by'] ?? 0;
    $this->verified_at = $args['verified_at'] ?? '';
    $this->deleted = $args['deleted'] ?? 0; 

  }

 
}
