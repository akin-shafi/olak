<?php
class AgentWallet extends DatabaseObject
{

  static protected $table_name = "agent_wallet";
  static protected $db_columns = ['id', 'agent_id', 'balance', 'payment_id', 'company_id', 'branch_id', 'created_at', 'updated_at', 'deleted'];

  public $id;
  public $agent_id;
  public $balance;
  public $payment_id;
  public $company_id;
  public $branch_id;
  public $created_at;
  public $updated_at;
  public $deleted;

  public function __construct($args = [])
  {
    $this->agent_id = $args['agent_id'] ?? '';
    $this->balance = $args['balance'] ?? 0;
    $this->payment_id = $args['payment_id'] ?? 0;
    $this->company_id = $args['company_id'] ?? '';
    $this->branch_id = $args['branch_id'] ?? '';
    $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted = $args['deleted'] ?? '';
  }




  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->agent_id)) {
      $this->errors[] = "agent id can not be empty.";
    }

    return $this->errors;
  }

  static public function find_by_agent_id($agent_id)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE agent_id='" . self::$database->escape_string($agent_id) . "'";
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
