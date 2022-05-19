<?php
class Promo extends DatabaseObject {
 
  static protected $table_name = "promos";
  static protected $db_columns = ['id','promo_code','amount','status','created_at','update_at','created_by','deleted'];

  public $id;
  public $promo_code;
  public $amount;
  public $status;
  public $created_at ;
  public $update_at ;
  public $created_by;
  public $deleted;

  public function __construct($args=[]) {
    $this->promo_code = $args['promo_code'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->status = $args['status'] ?? '';
    $this->created_by = $args['created_by'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    // if(is_blank($this->image)) {
    //    $this->errors[] = "Kindly Select a image.";
    // } 
    return $this->errors;
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_branch($city) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE city ='" . self::$database->escape_string($city) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
  
}

?>
