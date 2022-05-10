

<?php
class Request extends DatabaseObject
{
   protected static $table_name = "requests";
   protected static $db_columns = ['id', 'invoice_no', 'full_name', 'company_id', 'branch_id', 'item_name', 'unit', 'quantity', 'status', 'note', 'due_date', 'created_by', 'created_at', 'deleted'];

   public $id;
   public $invoice_no;
   public $due_date;
   public $full_name;
   public $item_name;
   public $unit;
   public $quantity;
   public $status;
   public $note;
   public $created_by;
   public $created_at;

   public $counts;
   public $deleted;

   public $company_name;
   public $company_id;
   public $branch_name;
   public $branch_id;
   public $address;


   const STATUS = [
      1 => 'New',
      2 => 'Approved',
      3 => 'Rejected',
   ];

   const UNIT = [
      1 => 'Gram(s) (g)',
      2 => 'Kilogram(s) (KG)',
      3 => 'Tonne(s) (t)',
      4 => 'Litre(s) (l)',
      5 => 'Barrel(s) (bbl)',
      6 => 'Gallon(s) (gl)',
   ];

   public function __construct($args = [])
   {
      $this->invoice_no   = $args['invoice_no'] ?? '';
      $this->due_date     = $args['due_date'] ?? '';
      $this->full_name    = $args['full_name'] ?? '';
      $this->company_id   = $args['company_id'] ?? '';
      $this->branch_id    = $args['branch_id'] ?? '';
      $this->item_name    = $args['item_name'] ?? '';
      $this->unit         = $args['unit'] ?? '';
      $this->quantity     = $args['quantity'] ?? '';
      $this->status       = $args['status'] ?? '1';
      $this->note         = $args['note'] ?? '';
      $this->created_by   = $args['created_by'] ?? '';
      $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
      $this->deleted      = $args['deleted'] ?? '';
   }


   protected function validate()
   {
      $this->errors = [];

      if (is_blank($this->full_name)) {
         $this->errors[] = "Full name is required.";
      }

      if (is_blank($this->item_name)) {
         $this->errors[] = "Item name is required.";
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

   public static function find_by_item($item)
   {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE item_name LIKE'%" . self::$database->escape_string($item) . "%'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
         return array_shift($obj_array);
      } else {
         return false;
      }
   }

   public static function find_by_invoices($item)
   {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE invoice_no ='" . self::$database->escape_string($item) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      return static::find_by_sql($sql);
   }

   public static function find_all_invoices()
   {
      $sql = "SELECT *, COUNT(invoice_no) AS counts FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $sql .= " GROUP BY invoice_no";
      $sql .= " ORDER BY id DESC ";
      return static::find_by_sql($sql);
   }


   public static function find_by_invoice($item)
   {
      $sql = "SELECT * FROM " . static::$table_name . " ";
      $sql .= "WHERE invoice_no ='" . self::$database->escape_string($item) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
         return array_shift($obj_array);
      } else {
         return false;
      }
   }


   public static function get_all_companies()
   {
      $sql = "SELECT * FROM olak_hr.companies ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      return static::find_by_sql($sql);
   }

   public static function get_all_branches($companyId)
   {
      $sql = "SELECT * FROM olak_hr.branches ";
      $sql .= "WHERE company_id ='" . self::$database->escape_string($companyId) . "'";
      $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      return static::find_by_sql($sql);
   }
}
