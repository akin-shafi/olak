<?php
class Category extends DatabaseObject {
 
  static protected $table_name = "categories";
  static protected $db_columns = ['id','parent_cat','category_name','status','created_at','updated_at','deleted'];

  public $id;
  public $parent_cat;
  public $category_name;
  public $status;
  public $created_at;
  public $updated_at;
  public $deleted;

  const CAT = [
    '1' => 'Antivirus',
    '2' => 'Editing Software',
    '3' => 'Electronics',
    '4' => 'Gadgets',
    '5' => 'Mobiles',
    '6' => 'Software'
  ];

  public function __construct($args=[]) {
    $this->parent_cat = $args['parent_cat'] ?? '';
    $this->category_name = $args['category_name'] ?? '';
    $this->status = $args['status'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->parent_cat)) {
      $this->errors[] = "Category cannot be blank.";
    } 
     
    if(is_blank($this->category_name)) {
      $this->errors[] = "Category name cannot be blank.";
    } elseif (!has_length($this->category_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Category name must be between 2 and 255 characters.";
    }

    // if(is_blank($this->status)) {
    //   $this->errors[] = "Status cannot be blank.";
    // } elseif (!has_length($this->status, array('min' => 2, 'max' => 255))) {
    //   $this->errors[] = "Status must be between 2 and 255 characters.";
    // }

    return $this->errors;
  }
 
  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_parent($pCat) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE parent_cat='" . self::$database->escape_string($pCat) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  
}
