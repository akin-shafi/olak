<?php
class Expenses extends DatabaseObject
{
    protected static $table_name = "expenses";
    protected static $db_columns = ['id', 'date', 'item','ref', 'attached', 'amount','note', 'updated_at','created_by', 'deleted'];
  
  public $id;
  public $date;
  public $item;
  public $ref;
  public $attached;
  public $amount;
  public $note;
 
  public $updated_at;
  public $created_by;
  public $deleted;
  public $counts;

    

    public function __construct($args=[])
    {
      $this->date = $args['date'] ?? '';
      $this->item = $args['item'] ?? '';
      $this->ref = $args['ref'] ?? '';
      $this->attached = $args['attached'] ?? '';
      $this->amount = $args['amount'] ?? '';
      $this->note = $args['note'] ?? '';
      $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
      $this->created_by = $args['created_by'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        

        if (is_blank($this->date)) {
            $this->errors[] = "date cannot be blank.";
        } 
        if (is_blank($this->item)) {
            $this->errors[] = "item cannot be blank.";
        } 
        if (is_blank($this->amount)) {
            $this->errors[] = "Amount cannot be blank.";
        } 
        

        return $this->errors;
    }

    public static function sum_of_expenses($options=[])
    {
      
      $from = $options['from'] ?? false;
      $to = $options['to'] ?? false;
      $created_by = $options['created_by'] ?? false;

      $sql = "SELECT SUM(amount) FROM " . static::$table_name . " ";

      if($created_by){
        $sql .= " WHERE created_by  ='" . self::$database->escape_string($created_by) . "'";
      }else{
        $sql .= " WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
      }

      
      
      if ($from && $to) {
        if ($from == $to) {
          $sql .= " AND DATE(date) = '" . self::$database->escape_string($from) . "' ";
        } elseif ($from > $to) {
          $sql .= " AND DATE(date) BETWEEN '" . self::$database->escape_string($to) . "' AND '" . self::$database->escape_string($from) . "' ";
        } elseif ($from < $to) {
          $sql .= " AND DATE(date) BETWEEN '" . self::$database->escape_string($from) . "' AND '" . self::$database->escape_string($to) . "' ";
        }
      } elseif ($from && !$to) {
        $sql .= " AND DATE(date) = '" . self::$database->escape_string($from) . "' ";
      } elseif (!$from && $to) {
        $sql .= " AND DATE(date) = '" . self::$database->escape_string($to) . "' ";
      }

     

      

      // echo $sql;
      $result_set = self::$database->query($sql);
      $row = $result_set->fetch_array();
      // pre_r( $row);
      return array_shift($row);
      
    }
 
    

    
}
