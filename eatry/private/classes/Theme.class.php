<?php
class Theme extends DatabaseObject
{
    protected static $table_name = "theme";
    protected static $db_columns = ['id','menu_color','active_color','theme_layout','collapse_sidebar','navbar_color','navbar_type','footer_type','admin_id','update_at','deleted'];

    public $id;
    public $menu_color;
    public $active_color;
    public $theme_layout;
    public $collapse_sidebar;
    public $navbar_color;
    public $navbar_type;
    public $footer_type;
    public $admin_id;
    public $update_at ;
    public $deleted;
    public $counts;

    const LAYOUT = [
      1 => '',
      2 => 'dark-layout',
      3 => 'semi-dark-layout',
    ];
    const MENU_COLOR = [
      1 => 'menu-light',
      2 => 'menu-dark',
    ];
    const MENU_TYPE = [
      1 => 'menu-expanded',
      2 => 'menu-collapsed',
    ];
    const NAVBAR_TYPE = [
      1 => 'navbar-hidden',
      2 => 'navbar-static',
      3 => 'navbar-sticky',
      4 => 'navbar-floating',
    ];
    

    public function __construct($args=[])
    {
        $this->menu_color = $args['menu_color'] ?? '';
        $this->active_color = $args['active_color'] ?? '';
        $this->theme_layout = $args['theme_layout'] ?? '';
        $this->collapse_sidebar = $args['collapse_sidebar'] ?? '';
        $this->navbar_color = $args['navbar_color'] ?? '';
        $this->navbar_type = $args['navbar_type'] ?? '';
        $this->footer_type = $args['footer_type'] ?? '';
        $this->admin_id = $args['admin_id'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';
    }

    public static function find_theme($id)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE admin_id ='" . self::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
        // $result = static::find_by_sql($sql);
        // return $result;
        
    }

   

}