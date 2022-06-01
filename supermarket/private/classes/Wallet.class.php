<?php
class Wallet extends DatabaseObject
{

  static protected $table_name = "wallets";
  static protected $db_columns = ['id', 'customer_id', 'name', 'card_number', 'month', 'year', 'cvv', 'wallet_credit', 'wallet_debit', 'phone', 'mode_of_payment', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $customer_id;
  public $name;
  public $card_number;
  public $month;
  public $year;
  public $cvv;
  public $wallet_credit;
  public $wallet_debit;
  public $phone;
  public $mode_of_payment;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->customer_id = $args['customer_id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->card_number = $args['card_number'] ?? '';
    $this->month = $args['month'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->cvv = $args['cvv'] ?? '';
    $this->wallet_credit = $args['wallet_credit'] ?? '';
    $this->wallet_debit = $args['wallet_debit'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->mode_of_payment = $args['mode_of_payment'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->name)) {
      $this->errors[] = "Name may not be empty.";
    }
    if (is_blank($this->card_number)) {
      $this->errors[] = "Card number may not be empty.";
    }
    if (is_blank($this->month)) {
      $this->errors[] = "Expiration month may not be empty.";
    }
    if (is_blank($this->year)) {
      $this->errors[] = "Expiration year may not be empty.";
    }
    if (is_blank($this->mode_of_payment)) {
      $this->errors[] = "Kindly Select a mode of payment.";
    }
    return $this->errors;
  }

  static public function find_by_debit($c_id)
  {
    $sql = "SELECT SUM(wallet_debit) as wallet_debit FROM " . static::$table_name . " ";
    $sql .= "WHERE customer_id='" . self::$database->escape_string($c_id) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_branch($city)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE city ='" . self::$database->escape_string($city) . "'";
    $obj_array = static::find_by_sql($sql);
    if (!empty($obj_array)) {
      return $obj_array;
    } else {
      return false;
    }
  }
}
