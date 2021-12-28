<?php
class SupportTicket extends DatabaseObject
{

	protected static $table_name = "support_ticket";
    protected static $db_columns = ['id','name','email','phone','message','ticket_no', 'created_at','deleted'];

    public $id;
	public $name;
	public $email;
	public $phone;
	public $message;
	public $ticket_no;
	public $created_at;
	public $deleted;
 
    public $counts;

    public function __construct($args=[])
    {

    	$this->name 		= $args['name'] ?? '';
		$this->email 		= $args['email'] ?? '';
		$this->phone 		= $args['phone'] ?? '';
		$this->message  	= $args['message'] ?? '';
		$this->ticket_no 	= $args['ticket_no'] ?? '';
		$this->created_at 	= $args['created_at'] ?? date('Y-m-d H:i:s');
		$this->deleted 		= $args['deleted'] ?? '';
    }

    protected function validate()
    {
        $this->errors = [];

        if (is_blank($this->name)) {
            $this->errors[] = "name cannot be blank.";
        }

        if (is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank.";
        }  elseif (!has_valid_email_format($this->email)) {
            $this->errors[] = "Email must be a valid format.";
        }

        if (is_blank($this->phone)) {
            $this->errors[] = "phone cannot be blank.";
        }

        if (is_blank($this->message)) {
            $this->errors[] = "message cannot be blank.";
        }


        return $this->errors;
    }


}