<?php
class Remittance extends DatabaseObject
{
  protected static $table_name = "remittance";
  protected static $db_columns = ['id', 'rate', 'quantity', 'amount', 'narration', 'created_by', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $rate;
  public $quantity;
  public $amount;
  public $narration;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public $total_amount;

  public function __construct($args = [])
  {
    $this->rate         = $args['rate'] ?? '';
    $this->quantity     = $args['quantity'] ?? '';
    $this->amount       = $args['amount'] ?? '';
    $this->narration    = $args['narration'] ?? '';
    $this->created_by   = $args['created_by'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at   = $args['updated_at'] ?? '';
    $this->deleted      = $args['deleted'] ?? '';
  }

  public static function get_total_remittance()
  {
    $sql = "SELECT SUM(amount) AS total_amount FROM " . static::$table_name . " ";
    $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
