

<?php
class RequestDetail extends DatabaseObject
{
   protected static $table_name = "request_details";
   protected static $db_columns = ['id', 'request_id', 'item_name', 'quantity', 'unit_price', 'amount', 'created_at', 'deleted'];

   public $id;
   public $request_id;
   public $item_name;
   public $quantity;
   public $unit_price;
   public $amount;
   public $created_at;

   public $counts;
   public $deleted;

   const COLOR = [
      1 => 'primary',
      2 => 'success',
      3 => 'danger',
   ];

   public function __construct($args = [])
   {
      $this->request_id   = $args['request_id'] ?? '';
      $this->item_name    = $args['item_name'] ?? '';
      $this->quantity     = $args['quantity'] ?? '';
      $this->unit_price   = $args['unit_price'] ?? '';
      $this->amount       = $args['amount'] ?? '';
      $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted      = $args['deleted'] ?? '';
   }


   protected function validate()
   {
      $this->errors = [];

      if (is_blank($this->item_name)) {
         $this->errors[] = "Item name is required.";
      }

      if (is_blank($this->quantity)) {
         $this->errors[] = "Quantity is required.";
      }

      if (is_blank($this->unit_price)) {
         $this->errors[] = "Price is required.";
      }

      return $this->errors;
   }

   static public function find_all_requests()
   {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $sql .= " ORDER BY name DESC ";
      return static::find_by_sql($sql);
   }

   public static function find_by_requests($item)
   {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE request_id ='" . self::$database->escape_string($item) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      return static::find_by_sql($sql);
   }

   public static function find_all_invoices()
   {
      $sql = "SELECT *, COUNT(request_id) AS counts FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $sql .= " GROUP BY request_id";
      $sql .= " ORDER BY id DESC ";
      return static::find_by_sql($sql);
   }

   // public static function find_by_request_id($item)
   // {
   //    $sql = "SELECT * FROM " . static::$table_name . " ";
   //    $sql .= "WHERE request_id ='" . self::$database->escape_string($item) . "'";
   //    $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
   //    $obj_array = static::find_by_sql($sql);

   //    if (!empty($obj_array)) {
   //       return array_shift($obj_array);
   //    } else {
   //       return false;
   //    }
   // }
}
