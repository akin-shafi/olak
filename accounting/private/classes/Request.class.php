<?php
class Request extends DatabaseObject
{
    protected static $table_name = "request";
    protected static $db_columns = ['id', 'status','req_no','firstname', 'lastname', 'email', 'phone', 'id_type', 'id_number', 'dob', 'nationality', 'trans_type', 'id_card_image','photo', 'documents', 'delivery_option', 'delivery_address','created_by', 'created_at', 'updated_at', 'deleted'];


    public $id;
    public $status;
    public $req_no;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;
    public $id_type;
    public $id_number;
    public $dob;
    public $nationality;
    public $trans_type;
    public $id_card_image;
    public $photo;
    public $documents;
    public $delivery_option;
    public $delivery_address;
    public $created_by;
    public $created_at;
    public $updated_at;
    public $deleted;
 
    public $counts;

    

    const STATUS = [
      1 => 'New',
      2 => 'In-view',
      3 => 'Assigned to Notary',
      4 => 'Completed',
      5 => 'Failed',
      6 => 'Not Responding',
    ];
    
    const TRANS_TYPE = [
      1 => 'Affidavit of SIM Card Loss',
      2 => 'Affidavit of Name Change',
      3 => 'Affidavit of Proof of Ownership',
      4 => 'Sworn Declaration of Age',
      5 => 'Confirmation of name',
      6 => 'Certified True Copy of documents',
      7 => 'Real Estate Transaction Closing',
      8 => 'Loan and Mortgage documents',
    ];


    public function __construct($args=[])
    {

        
        $this->status  = $args['status'] ?? 1;
        $this->req_no  = $args['req_no'] ?? '';
        $this->firstname  = $args['firstname'] ?? '';
        $this->lastname  = $args['lastname'] ?? '';
        $this->email  = $args['email'] ?? '';
        $this->phone  = $args['phone'] ?? '';
        $this->id_type  = $args['id_type'] ?? '';
        $this->id_number  = $args['id_number'] ?? '';
        $this->dob  = $args['dob'] ?? '';
        $this->nationality  = $args['nationality'] ?? '';
        $this->trans_type  = $args['trans_type'] ?? ''; 
        $this->id_card_image  = $args['id_card_image'] ?? '';
        $this->photo  = $args['photo'] ?? '';
        $this->documents  = $args['documents'] ?? '';
        $this->delivery_option  = $args['delivery_option'] ?? '';
        $this->delivery_address  = $args['delivery_address'] ?? '';
        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->deleted = $args['deleted'] ?? '';

    }

    public function full_name()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public static function uploadRequestFile($targetDir, $fileNames, $allowTypes){
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
        // return $storeFilesBasename;
        $loq = rtrim($storeFilesBasename, ',');
        $obj_array = explode(",", $loq);
        if(!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;

       }





    }
    public static function find_by_status($options=[])
    {
        $status = $options['status'] ?? false;
        $sql = "SELECT * FROM " . static::$table_name . " ";
        

        if ($status) {
          $sql .= "WHERE status ='" . self::$database->escape_string($status) . "'";
        }else{
            $sql .= "WHERE (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        }
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        // if(!empty($obj_array)) {
        //   return array_shift($obj_array);
        // } else {
        //   return false;
        // }
        return $obj_array;
    }



  
    
}
