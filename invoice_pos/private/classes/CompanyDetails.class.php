<?php

class CompanyDetails extends DatabaseObject {

  static protected $table_name = "company_details";
  static protected $db_columns = ['id', 'company_name', 'contact_person', 'address', 'country', 'city', 
  'state', 'zip_code', 'email', 'phone_no', 'mobile_no', 'web_address', 'app_address', 'social', 
  'bank_name', 'acct_name', 'acct_no' ];
 
 public $id; 
 public $company_name; 
 public $contact_person; 
 public $address; 
 public $country; 
 public $city; 
 public $state; 
 public $zip_code; 
 public $email; 
 public $phone_no; 
 public $mobile_no; 
 public $web_address; 
 public $app_address; 
 public $social; 
 public $bank_name; 
 public $acct_name; 
 public $acct_no;

 
  
  

  public function __construct($args=[]) {
   $this->id = $args['company_name'] ?? ''; 
   $this->company_name = $args['company_name'] ?? ''; 
   $this->contact_person = $args['company_name'] ?? ''; 
   $this->address = $args['company_name'] ?? ''; 
   $this->country = $args['company_name'] ?? ''; 
   $this->city = $args['company_name'] ?? ''; 
   $this->state = $args['company_name'] ?? ''; 
   $this->zip_code = $args['company_name'] ?? ''; 
   $this->email = $args['company_name'] ?? ''; 
   $this->phone_no = $args['company_name'] ?? ''; 
   $this->mobile_no = $args['company_name'] ?? ''; 
   $this->web_address = $args['company_name'] ?? ''; 
   $this->app_address = $args['company_name'] ?? ''; 
   $this->social = $args['company_name'] ?? ''; 
   $this->bank_name = $args['company_name'] ?? ''; 
   $this->acct_name = $args['company_name'] ?? ''; 
   $this->acct_no = $args['company_name'] ?? '';

    
  }
  

  
 
//   static public function find_by_company_name($state_company_name){
//     $sql = "SELECT * FROM " . static::$table_name . " ";
//     $sql .= "WHERE name='" . self::$database->escape_string($state_name) . "'";
//     $obj_array = static::find_by_sql($sql);

//     if(!empty($obj_array)) {
//       $result = array_shift($obj_array);
//       return $result;
//     } else {
//       return false;
//     }

//   }

  
}

?>
