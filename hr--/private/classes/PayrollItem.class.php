

<?php
class PayrollItem extends DatabaseObject
{
    protected static $table_name = "payroll_item";
    protected static $db_columns = ['id', 'item', 'category', 'addon', 'amount', 'created_at', 'deleted'];

    public $id;
    public $item;
    public $addon;
    public $category;
    public $amount;
    public $created_at;
    public $deleted;
    public $counts;


    const PAYROLL_CATEGORY = [
        1 => 'Addition',
        2 => 'Overtime',
        3 => 'Deduction',
    ];

    const ITEM_GROUP = [
        1 => 'Monthly remuneration',
        2 => 'Additional remuneration',
    ];

    public function __construct($args = [])
    {
        $this->item = $args['item'] ?? '';
        $this->addon = $args['addon'] ?? '';
        $this->category = $args['category'] ?? '';
        $this->amount = $args['amount'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }


    public static function find_by_category($category)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE category='" . self::$database->escape_string($category) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }

    public static function find_all_payroll($option = [])
    {
        $category = $option['category'] ?? false;

        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";

        if ($category) {
            $sql .= " AND category='" . self::$database->escape_string($category) . "'";
        }

        $sql .= " ORDER BY id ASC ";
        return static::find_by_sql($sql);
    }


    public static function find_by_item_name($item)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE item LIKE'%" . self::$database->escape_string($item) . "%'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
}
