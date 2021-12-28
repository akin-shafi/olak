<?php
class MailerSetup extends DatabaseObject
{
    protected static $table_name = "mailersetup";
    protected static $db_columns = ['id', 'host', 'port', 'username', 'password', 'fromEmail', 'fromName', 'deleted'];
  
    public $id;
    public $host;
    public $port;
    public $username;
    public $password;
    public $fromEmail;
    public $fromName;
    public $deleted;

    
    public function __construct($args=[])
    {
      $this->host = $args['host'] ?? '';
      $this->port = $args['port'] ?? '';
      $this->username = $args['username'] ?? '';
      $this->password = $args['password'] ?? '';
      $this->fromEmail = $args['fromEmail'] ?? '';
      $this->fromName = $args['fromName'] ?? '';
      $this->deleted = $args['deleted'] ?? '';
    }

    

    protected function validate()
    {
        $this->errors = [];
        

        return $this->errors;
    }
    


    
}
