

<?php
class Request extends DatabaseObject
{
   protected static $table_name = "requests";
   protected static $db_columns = ['id', 'invoice_no', 'grand_total', 'full_name', 'company_id', 'branch_id', 'vendor_img', 'status', 'note', 'due_date', 'created_by', 'created_at', 'deleted'];

   public $id;
   public $invoice_no;
   public $grand_total;
   public $full_name;
   public $company_id;
   public $branch_id;
   public $vendor_img;
   public $status;
   public $note;
   public $due_date;
   public $created_by;
   public $created_at;

   public $counts;
   public $deleted;

   public $item_name;
   public $quantity;
   public $unit_price;
   public $request_id;

   public $year;
   public $month;
   public $week;

   const STATUS = [
      1 => 'New',
      2 => 'Approved',
      3 => 'Rejected',
   ];

   public function __construct($args = [])
   {
      $this->invoice_no   = $args['invoice_no'] ?? '';
      $this->grand_total  = $args['grand_total'] ?? '';
      $this->full_name    = $args['full_name'] ?? '';
      $this->company_id   = $args['company_id'] ?? '';
      $this->branch_id    = $args['branch_id'] ?? '';
      $this->vendor_img   = $args['vendor_img'] ?? '';
      $this->status       = $args['status'] ?? 1;
      $this->note         = $args['note'] ?? '';
      $this->due_date     = $args['due_date'] ?? '';
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

      if (is_blank($this->due_date)) {
         $this->errors[] = "Due date is required.";
      }

      return $this->errors;
   }

   static public function find_all_requests()
   {
      $sql = "SELECT req.id, req.invoice_no, req.grand_total, req.full_name, req.branch_id, req.vendor_img, req.status, req.note, req.due_date, req.created_by, req.created_at, det.item_name, SUM(det.quantity) AS quantity, sum( det.unit_price) AS unit_price, COUNT(det.request_id) AS counts FROM " . static::$table_name . " AS req ";
      $sql .= "JOIN request_details AS det ON req.id = det.request_id ";
      $sql .= "WHERE (req.deleted IS NULL OR req.deleted = 0 OR req.deleted = '') ";
      $sql .= "GROUP BY req.invoice_no ";
      $sql .= "ORDER BY req.id DESC ";

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

   public static function find_by_expenses()
   {
      $sql = "SELECT SUM(grand_total) AS grand_total FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $obj_array = static::find_by_sql($sql);

      if (!empty($obj_array)) {
         return array_shift($obj_array);
      } else {
         return false;
      }
   }


   public static function get_weekly_expenses()
   {
      $sql = "SELECT SUM(grand_total) AS grand_total, CONCAT ( STR_TO_DATE(CONCAT(YEARWEEK(created_at, 2), ' Sunday'), '%X%V %W'), ',', STR_TO_DATE(CONCAT(YEARWEEK(created_at, 2), ' Sunday'), '%X%V %W') + INTERVAL 6 DAY ) AS week FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $sql .= "GROUP BY YEARWEEK(created_at, 2) ";
      $sql .= "ORDER BY YEARWEEK(created_at, 2) ";

      return static::find_by_sql($sql);
   }


   public static function get_monthly_expenses()
   {
      $sql = "SELECT year(created_at) AS year, month(created_at) AS month, SUM(grand_total) AS grand_total  FROM " . static::$table_name . " ";
      $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      $sql .= "GROUP BY year(created_at), month(created_at) ";
      $sql .= "ORDER BY year(created_at), month(created_at) ";

      return static::find_by_sql($sql);
   }
}
