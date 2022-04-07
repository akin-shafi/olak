<?php

class Vehicle extends DatabaseObject
{

  static protected $table_name = "vehicles";
  static protected $db_columns = ['id', 'client_id', 'plate_no', 'make', 'model', 'year', 'last_service', 'deleted'];

  public $id;
  public $client_id;
  public $plate_no;
  public $make;
  public $model;
  public $year;
  public $last_service;
  public $deleted;

  public function __construct($args = [])
  {
    $this->client_id = $args['client_id'] ?? '';
    $this->plate_no = $args['plate_no'] ?? '';
    $this->make = $args['make'] ?? '';
    $this->model = $args['model'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->last_service = $args['last_service'] ?? '';
    $this->deleted = $args['deleted'] ?? NULL;
  }

  protected function validate()
  {
    $this->errors = [];

    // if(is_blank($this->vin)) {
    //   $this->errors[] = "Vehicle Identification Number is required.";
    // } 

    if (is_blank($this->make)) {
      $this->errors[] = "Make is required.";
    }

    if (is_blank($this->model)) {
      $this->errors[] = "Address is required";
    }

    if (is_blank($this->year)) {
      $this->errors[] = "Year is required";
    } elseif (!has_length($this->year, array('min' => 4, 'max' => 5))) {
      $this->errors[] = "Year must contain 4 or 5 characters";
    }

    return $this->errors;
  }
  static public function find_client_id($client_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE client_id='" . self::$database->escape_string($client_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_vehicle($client_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE client_id='" . self::$database->escape_string($client_id) . "'";
    return static::find_by_sql($sql);
  }


  // static public function find_by_name($state_name){
  //   $sql = "SELECT * FROM " . static::$table_name . " ";
  //   $sql .= "WHERE name='" . self::$database->escape_string($state_name) . "'";
  //   $obj_array = static::find_by_sql($sql);

  //   if(!empty($obj_array)) {
  //     $result = array_shift($obj_array);
  //     return $result;
  //   } else {
  //     return false;
  //   }

  // }




}
