<?php
class Department extends DatabaseObject
{
    protected static $table_name = "departments";
    protected static $db_columns = ['id', 'name', 'updated_at', 'created_at', 'deleted'];

    public $id;
    public $name;

    public function __construct($args = [])
    {
        $this->name           = $args['name'] ?? '';
        $this->updated_at     = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at     = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted        = $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->name)) {
            $this->errors[] = "Department name cannot be blank.";
        }
        return $this->errors;
    }

    public static function find_by_department_name($name)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
}
