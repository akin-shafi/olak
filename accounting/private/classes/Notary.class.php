<?php
class Notary extends DatabaseObject
{
    protected static $table_name = "notary";
    protected static $db_columns = ['id', 'notary_no', 'supreme_court_no','status', 'email', 'firstname', 'lastname', 'phone', 'dob', 'gender', 'business_address', 'language', 'id_type', 'id_number', 'member', 'like_to_be', 'kin_fullname', 'kin_phone', 'kin_email', 'relationship_to_kin',  'id_card_image', 'photo','documents' ,'created_by', 'created_at', 'updated_at', 'deleted' ];

    public $id;
    public $notary_no;
    public $supreme_court_no;
    public $status;
    public $email;
    public $firstname;
    public $lastname;
    public $phone;
    public $dob;
    public $gender;
    public $business_address;
    public $language;
    public $id_type;
    public $id_number; 
    public $member; 
    public $like_to_be; 
    public $kin_fullname;
    public $kin_phone;
    public $kin_email;
    public $relationship_to_kin;

    public $id_card_image;
    public $photo;
    public $documents;
    public $created_by;
    public $created_at;
    public $updated_at;
    public $deleted;

 
    public $counts;

    const ID_TYPE = [
      1 => 'National ID Card',
      2 => 'Voters Card',
      3 => 'Drivers lincense',
      4 => 'Passport',
    ];

    const GENDER = [
      1 => 'male',
      2 => 'female',
    ];
    const MEMEBER = [
      1 => 'Yes',
      2 => 'No',
    ];
    const LIKE_TO_BE = [
      1 => 'Yes',
      2 => 'No',
    ];

    const LANGUAGE = [
      1 => 'English',
      2 => 'Hausa',
      3 => 'Igbo',
      4 => 'Youruba',
      5 => 'Pidgin',
      6 => 'Others',
    ];
    const STATUS = [
      2 => 'Verified',
      1 => 'Unverified',
    ];


    public function __construct($args=[])
    {

        $this->notary_no = $args['notary_no'] ?? '';
        $this->supreme_court_no = $args['supreme_court_no'] ?? '';
        $this->status = $args['status'] ?? 1;
        $this->email = $args['email'] ?? '';
        $this->firstname = $args['firstname'] ?? '';
        $this->lastname = $args['lastname'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->dob = $args['dob'] ?? '';
        $this->gender = $args['gender'] ?? '';
        $this->business_address = $args['business_address'] ?? '';
        $this->language = $args['language'] ?? '';
        $this->id_type = $args['id_type'] ?? '';
        $this->id_number = $args['id_number'] ?? ''; 
        $this->member = $args['member'] ?? ''; 
        $this->like_to_be = $args['like_to_be'] ?? ''; 
        $this->kin_fullname = $args['kin_fullname'] ?? '';
        $this->kin_phone = $args['kin_phone'] ?? '';
        $this->kin_email = $args['kin_email'] ?? '';
        $this->relationship_to_kin = $args['relationship_to_kin'] ?? '';

        $this->id_card_image  = $args['id_card_image'] ?? '';
        $this->photo  = $args['photo'] ?? '';
        $this->documents = $args['documents'] ?? '';
        // $this->notary_certificate = $args['notary_certificate'] ?? '';


        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';

    }

    public function full_name()
    {
        return $this->firstname . " " . $this->lastname;
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }elseif (!has_unique_email_notary($this->email, $this->id ?? 0)) {
          $this->errors[] = "Email already exist. Try another.";
        }

        if (is_blank($this->supreme_court_no)) {
            $this->errors[] = "Supreme Court Number cannot be blank.";
        } 

        if (is_blank($this->firstname)) {
            $this->errors[] = "First name cannot be blank.";
        } elseif (!has_length($this->firstname, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "First name must be between 2 and 255 characters.";
        }

        if (is_blank($this->lastname)) {
            $this->errors[] = "Last name cannot be blank.";
        } elseif (!has_length($this->lastname, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Last name must be between 2 and 255 characters.";
        }

        if (is_blank($this->phone)) {
            $this->errors[] = "Phone Number cannot be blank.";
        }

        if (is_blank($this->business_address)) {
            $this->errors[] = "Business Address cannot be blank.";
        }

        

        return $this->errors;
    }

    public static function find_by_email($email)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }
    public static function storeFileName($options=[])
    {
        $id_card_image = $options['id_card_image'] ?? "";
        $photo = $options['photo'] ?? "";
        $notary_cert = $options['notary_cert'] ?? "";

        pre_r($id_card_image);
    }
    public static function uploadFile($targetDir, $fileNames, $allowTypes){
        // $error= '';
        $storeFilesBasename='';
        foreach($fileNames as $key => $val){
            $fileName = basename($fileNames[$key]);
            $newfilename = date('dmYHis').str_replace(" ", "", basename($fileName));
            $targetFilePath = $targetDir . $newfilename; 
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server  and  Move file to destination folder
                $movedFile = move_uploaded_file($_FILES["file"]["tmp_name"][$key], $targetFilePath);
                // $movedFile = true;
                if($movedFile){ 
                    $storeFilesBasename .= "".$newfilename.",";

                }else{ 
                    $errors = "Sorry, there was a problem uploading ";
                } 
            }else{ 
                // $errors = json_encode($_FILES['file']['type']. " is not a permitted type of file.");
                $errors = "Error: One of the selected file is not a permitted type of file.";
                // $errorUploadType .= $_FILES['file']['name'][$key].' | '; 
            }
        }
        return $storeFilesBasename;
        // $loq = rtrim($storeFilesBasename, ',');
        // $obj_array = explode(",", $loq);
        // if(!empty($obj_array)) {
        //     return $obj_array;
        // } else {
        //     return false;
        // }
    }

    public static function find_by_status($status)
    {

        $sql = "SELECT * FROM " . static::$table_name . " ";
        

        if ($status) {
          $sql .= "WHERE status ='" . self::$database->escape_string($status) . "'";
        }else{
            $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        }
        $sql .= "AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        // if(!empty($obj_array)) {
        //   return array_shift($obj_array);
        // } else {
        //   return false;
        // }
        return $obj_array;
    }
    
}
