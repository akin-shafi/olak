<?php
class Company extends DatabaseObject
{
  protected static $table_name = "companies";
  protected static $db_columns = ['id', 'logo', 'company_name', 'registration_no', 'created_at',  'deleted'];

  public $id;
  public $logo;
  public $company_name;
  public $registration_no;
  public $created_at;
  public $deleted;


  public $counts;

  public function __construct($args = [])
  {
    $this->logo            = $args['logo'] ?? '';
    $this->company_name    = $args['company_name'] ?? '';
    $this->registration_no = $args['registration_no'] ?? '';
    $this->created_at      = $args['created_at'] ?? date('Y-m-d H:i:s');
    $this->deleted         = $args['deleted'] ?? '';
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->company_name)) {
      $this->errors[] = "Company name is required.";
    }

    return $this->errors;
  }
}
