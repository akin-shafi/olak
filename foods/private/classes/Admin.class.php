<?php
class Admin extends DatabaseObject
{
    protected static $table_name = "admins";
    protected static $db_columns = ['id', 'full_name', 'email', 'phone', 'profile_img', 'address', 'hashed_password', 'reset_password', 'admin_level', 'company_id', 'branch_id', 'status', 'created_at', 'updated_at', 'created_by', 'deleted'];

    public $id;
    public $full_name;
    public $email;
    public $phone;
    public $profile_img;
    public $address;
    public $hashed_password;
    public $reset_password;
    public $admin_level;
    public $company_id;
    public $branch_id;
    public $status;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $deleted;

    public $password;
    public $confirm_password;
    protected $password_required = true;

    const ADMIN_LEVEL = [
        1 => 'Super Admin',
        2 => 'Chairman',
        3 => 'General Manager',
        4 => 'Head Account',
        5 => 'Compliance',
        6 => 'Manager',
        7 => 'Supervisor',
        8 => 'Special',
    ];

    const STATUS = [
        1 => 'Active',
        0 => 'Inactive',
    ];

    public function __construct($args = [])
    {
        $this->full_name        = $args['full_name'] ?? '';
        $this->email            = $args['email'] ?? '';
        $this->phone            = $args['phone'] ?? '';
        $this->profile_img      = $args['profile_img'] ?? '';
        $this->address          = $args['address'] ?? '';
        $this->reset_password   = $args['reset_password'] ?? 0;
        $this->password         = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->admin_level      = $args['admin_level'] ?? '';
        $this->company_id       = $args['company_id'] ?? '';
        $this->branch_id        = $args['branch_id'] ?? '';
        $this->status           = $args['status'] ?? '';
        $this->created_at       = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at       = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->created_by       = $args['created_by'] ?? '';
        $this->deleted          = $args['deleted'] ?? '';
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
        } else {
            $this->password_required = false;
        }
        return parent::update();
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->full_name)) {
            $this->errors[] = "Full name cannot be blank.";
        }

        if (is_blank($this->phone)) {
            $this->errors[] = "Phone number cannot be blank.";
        }


        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        } elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        } elseif (!has_unique_email_admin($this->email, $this->id ?? 0)) {
            $this->errors[] = "Email already exist. Try another.";
        }

        if ($this->password_required) {
            if (is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank.";
            }

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

    public static function find_by_status($status)
    {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql .= "WHERE status ='" . self::$database->escape_string($status) . "'";
        $sql .= " AND (deleted IS NULL OR deleted = 0 OR deleted = '') ";
        $obj_array = static::find_by_sql($sql);
        if (!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    public static function find_all_employee()
    {
        $sql = "SELECT ohre.first_name, ohre.last_name, ohre.company, ohre.branch, ohre.department, ohre.job_title, ohre.grade_step, ohre.deleted FROM olak_hr.employees AS ohre WHERE ohre.company LIKE 'petroleum' ";
        $sql .= " AND (ohre.deleted IS NULL OR ohre.deleted = 0 OR ohre.deleted = '') ";
        $sql .= " ORDER BY ohre.first_name DESC ";

        return static::find_by_sql($sql);
    }
}
