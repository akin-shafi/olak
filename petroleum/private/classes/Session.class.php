<?php

class Session {

  private $admin_id;
  public  $client_id;
  public  $rider_id;

  public  $email;
  public  $admin;
  public  $rider;

  private $last_login;
  private $client = 'aaj_';

  const MAX_LOGIN_AGE = 60*60*24; // 1 day

  public function __construct() {
    session_start();
    $this->check_stored_login();
    // $this->check_client_stored_login();
  }

  public function login($admin, $client='',$rider='') {
    if($admin) {

      //this first part is general saved session for admin,clients and riders
      // prevent session fixation attacks
      session_regenerate_id();
      $this->admin_id = $_SESSION[$this->client . 'admin_id'] = $admin->id;
      $this->last_login = $_SESSION[$this->client . 'last_login'] = time();
      
      if ($client) { //this part for the client login saved session

        $this->client_id = $_SESSION[$this->client . 'client_id'] = $admin->id;
        $this->email = $_SESSION[$this->client . 'email'] = $admin->email;

      }elseif ($rider === true) { //this part for the rider login saved session

        $this->rider_id = $_SESSION[$this->client . 'rider_id'] = $admin->email;
        $this->email = $_SESSION[$this->client . 'email'] = $admin->email;

      }else{ //this part for the admin login saved session
        $this->email = $_SESSION[$this->client . 'email'] = $admin->email;
      }
      
      

    }
    return true;
  }

  public function is_logged_in() {
    // return isset($this->admin_id);
    return isset($this->admin_id) && $this->last_login_is_recent();
  }
  public function close_register(){
    unset($_SESSION["register"]);
  }
  public function logout($client='',$rider='') {
    unset($_SESSION[$this->client . 'admin_id']);
    unset($_SESSION[$this->client . 'last_login']);
    unset($_SESSION['back']);

    // unset($_SESSION["register"]);

    unset($this->admin_id);
    unset($this->last_login);
    if ($client) {
      unset($_SESSION[$this->client . 'email']);
      unset($_SESSION[$this->client . 'client_id']);
      unset($this->email);
      unset($this->client_id);
    } elseif ($rider) {
      unset($_SESSION[$this->client . 'rider_id']);
      unset($this->rider_id);
    } else {
      unset($_SESSION[$this->client . 'email']);
      unset($this->admin);
    }
    
    return true;


   


  }

  private function check_stored_login() {

    if(isset($_SESSION[$this->client . 'admin_id'])) {

      $this->admin_id = $_SESSION[$this->client . 'admin_id'];
      $this->last_login = $_SESSION[$this->client . 'last_login'];

      if (isset($_SESSION[$this->client . 'client_id'])) {

        $this->client_id = $_SESSION[$this->client . 'client_id'];
        $this->email = $_SESSION[$this->client . 'email'];

      }elseif (isset($_SESSION[$this->client . 'rider_id'])) {

        $this->rider_id = $_SESSION[$this->client . 'rider_id'];

      }else{

        $this->admin = $_SESSION[$this->client . 'email'];
      
      }

    }

  }


  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }


  public function message($msg="") {
    if(!empty($msg)) {
      // Then this is a "set" message
      $_SESSION[$this->client . 'message'] = $msg;
      return true;
    } else {
      // Then this is a "get" message
      return $_SESSION[$this->client . 'message'] ?? '';
    }
  }

  public function clear_message() {
    unset($_SESSION[$this->client . 'message']);
  }
}

?>
