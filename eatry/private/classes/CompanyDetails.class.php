<?php

class CompanyDetails extends DatabaseObject {

  static protected $table_name = "company_details";
  static protected $db_columns = ['id', 'product','color', 'company_name', 'contact_person', 'address', 'country', 'city', 
  'state', 'zip_code', 'email', 'phone_no', 'mobile_no', 'web_address', 'app_address', 'social', 
  'bank_name', 'acct_name', 'acct_no' ];
 
 
 public $id; 
 public $product; 
 public $color; 
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

 const COLOR = [
    1 => 'red',
    3 => 'green',
    4 => 'blue',
    5 => 'black',
    6 => 'white',
    6 => 'yellow',
  ];

  const PRODUCT = [
      1 => 'PMS',
      2 => 'Restaurant',
      3 => 'Bar',  
    ];
  
  

  public function __construct($args=[]) {
   $this->product = $args['product'] ?? ''; 
   $this->color = $args['color'] ?? ''; 
   $this->company_name = $args['company_name'] ?? ''; 
   $this->contact_person = $args['contact_person'] ?? ''; 
   $this->address = $args['address'] ?? ''; 
   $this->country = $args['country'] ?? ''; 
   $this->city = $args['city'] ?? ''; 
   $this->state = $args['state'] ?? ''; 
   $this->zip_code = $args['zip_code'] ?? ''; 
   $this->email = $args['email'] ?? ''; 
   $this->phone_no = $args['phone_no'] ?? ''; 
   $this->mobile_no = $args['mobile_no'] ?? ''; 
   $this->web_address = $args['web_address'] ?? ''; 
   $this->app_address = $args['app_address'] ?? ''; 
   $this->social = $args['social'] ?? ''; 
   $this->bank_name = $args['bank_name'] ?? ''; 
   $this->acct_name = $args['acct_name'] ?? ''; 
   $this->acct_no = $args['acct_no'] ?? '';

    
  }
  
  protected function validate()
    {
        $this->errors = [];
        if (is_blank($this->product)) {
            $this->errors[] = "product cannot be blank.";
        }
        if (is_blank($this->color)) {
            $this->errors[] = "Color cannot be blank.";
        } 

        if (is_blank($this->company_name)) {
            $this->errors[] = "Company name cannot be blank.";
        } 

        if (is_blank($this->address)) {
            $this->errors[] = "Address cannot be blank.";
        }

        if (is_blank($this->phone_no)) {
            $this->errors[] = "Phone number cannot be blank.";
        } 

        // elseif (!has_length($this->email, array('max' => 255))) {
        //     $this->errors[] = "Last name must be less than 255 characters.";
        // } elseif (!has_valid_email_format($this->email)) {
        //     $this->errors[] = "Email must be a valid format.";
        // }elseif (!has_unique_email_admin($this->email, $this->id ?? 0)) {
        //   $this->errors[] = "Email already exist. Try another.";
        // }

        
        return $this->errors;
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
