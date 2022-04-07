<?php
class Brand extends DatabaseObject {
 
  static protected $table_name = "brands";
  static protected $db_columns = ['id','brand_name','status','created_at','updated_at','deleted'];

  public $id;
  public $brand_name;
  public $status;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args=[]) {
    $this->brand_name = $args['brand_name'] ?? '';
    $this->status = $args['status'] ?? '';
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }


  protected function validate() {
    $this->errors = [];

    if(is_blank($this->brand_name)) {
      $this->errors[] = "Brand name cannot be blank.";
    } elseif (!has_length($this->brand_name, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Brand name must be between 2 and 255 characters.";
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

  
}

?>
