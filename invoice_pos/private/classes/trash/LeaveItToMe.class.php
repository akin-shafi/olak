<?php
class LeaveItToMe extends DatabaseObject {
 
  static protected $table_name = "contact";
  static protected $db_columns = ['id', 'FirstName', 'LastName','address','date'];

  public $id;
  public $FirstName;
  public $LastName;
  public $address;
  public $date;

  public function __construct($args=[]) {
    $this->FirstName = $args['FirstName'] ?? '';
    $this->LastName = $args['LastName'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->date = $args['date'] ?? date('Y-m-d H:i:s');
  }

  public function full_name() {
    return $this->FirstName . " " . $this->LastName;
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->FirstName)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->FirstName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($this->LastName)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->LastName, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($this->address)) {
      $this->errors[] = "Address cannot be blank.";
    } elseif (!has_length($this->address, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Address must be between 2 and 255 characters.";
    }

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
