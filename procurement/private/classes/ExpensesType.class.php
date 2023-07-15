<?php
class ExpensesType extends DatabaseObject
{
  protected static $table_name = "expenses_type";
  protected static $db_columns =  ['id', 'expense_account', 'created_at', 'deleted'];
  public $id;                     // id
  public $expense_account;        // expense_account
  public $created_at;             // created_at
  public $deleted;                // deleted
  

  public function __construct($args = [])
  {
    $this->expense_account   = $args['expense_account'] ?? '';
    $this->created_at   = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted      = $args['deleted'] ?? '';
  }

  
}
