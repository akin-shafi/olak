

<?php
class Product extends DatabaseObject
{
    protected static $table_name = "products";
    protected static $db_columns = ['id', 'name', 'tank', 'rate', 'created_at', 'deleted'];

    public $id;
    public $name;
    public $tank;
    public $rate;
    public $deleted;

    public function __construct($args = [])
    {
        $this->name = $args['name'] ?? '';
        $this->tank = $args['tank'] ?? '1';
        $this->rate = $args['rate'] ?? '';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

    static public function find_all_product()
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY name DESC ";
        return static::find_by_sql($sql);
    }

    static public function grouped_products()
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " GROUP BY name";
        $sql .= " ORDER BY name DESC ";
        return static::find_by_sql($sql);
    }

    public static function find_by_name($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);

        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
}
