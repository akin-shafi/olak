<?php
class Admin extends DatabaseObject
{
    protected static $table_name = "admin";
    protected static $db_columns = ['id','first_name','last_name','email','profile_img','hashed_password','admin_level','account_status', 'process_request','created_at','updated_at','created_by','reset_password','deleted'];

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $profile_img;
    public $hashed_password;
    public $password; 
    public $confirm_password;
    protected $password_required = true;
    public $admin_level;
    public $account_status;
    public $process_request;
    public $created_at ;
    public $updated_at ;
    public $created_by;
    public $reset_password;
    public $deleted;

 
    public $counts;

    const ADMIN_LEVEL = [
      1 => 'Super Admin',
      2 => 'Admin',
      3 => 'Support',
    ];

    const ACCOUNT_STATUS = [
      1 => 'Active',
      0 => 'Inactive',
    ];
    
    const PROCESS_REQUEST = [
      1 => 'Yes',
      0 => 'No',
    ];


    public function __construct($args=[])
    {
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->profile_img = $args['profile_img'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        // $this->hashed_password = $args['hashed_password'] ?? '';
        $this->admin_level = $args['admin_level'] ?? '';
        $this->account_status = $args['account_status'] ?? 1;
        $this->process_request = $args['process_request'] ?? 0;
        $this->created_by = $args['created_by'] ?? '';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->reset_password = $args['reset_password'] ?? 0;
        $this->deleted = $args['deleted'] ?? '';
    }

    public function full_name()
    {
        return $this->first_name . " " . $this->last_name;
    }


    protected function set_hashed_password()
    {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function verify_password($password)
    {
        return password_verify($password, $this->hashed_password);
    }

    protected function create()
    {
        $this->set_hashed_password();
        return parent::create();
    }

    protected function update()
    {
        if ($this->password != '') {
            $this->set_hashed_password();
        // validate password
        } else {
            // password not being updated, skip hashing and validation
            $this->password_required = false;
        }
        return parent::update();
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->first_name)) {
            $this->errors[] = "First name cannot be blank.";
        } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "First name must be between 2 and 255 characters.";
        }

        if (is_blank($this->last_name)) {
            $this->errors[] = "Last name cannot be blank.";
        } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 255))) {
            $this->errors[] = "Last name must be between 2 and 255 characters.";
        }
    
        // if(is_blank($this->image)) {
        //    $this->errors[] = "Kindly Select a image.";
        // }

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }elseif (!has_unique_email_admin($this->email, $this->id ?? 0)) {
          $this->errors[] = "Email already exist. Try another.";
        }

        if ($this->password_required) {
            if (is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            } 
            // elseif (!has_length($this->password, array('min' => 8))) {
            //     $this->errors[] = "Password must contain 8 or more characters";
            // } elseif (!preg_match('/[A-Z]/', $this->password)) {
            //     $this->errors[] = "Password must contain at least 1 uppercase letter";
            // } elseif (!preg_match('/[a-z]/', $this->password)) {
            //     $this->errors[] = "Password must contain at least 1 lowercase letter";
            // } elseif (!preg_match('/[0-9]/', $this->password)) {
            //     $this->errors[] = "Password must contain at least 1 number";
            // } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
            //     $this->errors[] = "Password must contain at least 1 symbol";
            // }

            if (is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank.";
            } elseif ($this->password !== $this->confirm_password) {
                $this->errors[] = "Password and confirm password must match.";
            }
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

    public static function find_by_acctount_type($account_status)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE account_status ='" . self::$database->escape_string($account_status) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $sql .= " ORDER BY id DESC ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return $obj_array;
        } else {
            return false;
        }
    }
}
