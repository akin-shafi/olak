<?php
class Booking extends DatabaseObject {
 
  static protected $table_name = "bookings";
  static protected $db_columns = ['id','client_id','plate_no','date','details','service','created_by','created_at','updated_at','deleted'];
  
  public $id;
  public $client_id;
  public $plate_no;
  public $date;
  public $details;
  public $service;
  public $created_by;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args=[]) {
    $this->client_id = $args['client_id'] ?? '';
    $this->plate_no = $args['plate_no'] ?? '';
    $this->date = $args['date'] ??  date('Y-m-d');
    $this->details = $args['details'] ?? '';
    $this->service = $args['service'] ?? 0;
    $this->created_by = $args['created_by'] ?? '';
    $this->created_at = $args['created_at'] ??  date('Y-m-d H:i:s');
    $this->updated_at = $args['updated_at'] ??  date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    //  if(is_blank($this->client_id)) {
    //   $this->errors[] = "Sorry you have not selected any client";
    // } 

    if(is_blank($this->details)) {
      $this->errors[] = "Details cannot be blank.";
    } elseif (!has_length($this->details, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Details name must be between 2 and 255 characters.";
    }

    // if(is_blank($this->status)) {
    //   $this->errors[] = "Status cannot be blank.";
    // } elseif (!has_length($this->status, array('min' => 2, 'max' => 255))) {
    //   $this->errors[] = "Status must be between 2 and 255 characters.";
    // }

    return $this->errors;
  }

  
 
  // static public function find_by_username($username) {
  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
  //   $obj_array = static::find_by_sql($sql);
  //   if(!empty($obj_array)) {
  //     return array_shift($obj_array);
  //   } else {
  //     return false;
  //   }
  // }

  
}
