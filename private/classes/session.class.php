<?php

class session {
  private $user_id;
  public $username;
  public $user_level;
  private $last_login;
  public const MAX_LOGIN_AGE = 60 * 60 * 24; // one day

  public function __construct() {
    session_start();
    $this->check_stored_login();
    }
    
  public function login($user) {
    if($user) {
      // protect against session fixation attacks
      session_regenerate_id();

      $this->user_id = $user->user_id;
      $_SESSION['user_id'] = $user->user_id;
            
      $this->username = $user->username;
      $_SESSION['username'] = $user->username;

      $this->user_level = $user->user_level;
      $_SESSION['user_level'] = $user->user_level;
            
      $this->last_login = $_SESSION['last_login'] = time();
    }
      return true;
  }

  public function is_logged_in() {
   // return isset($this->member_id);
   return isset($this->user_id) && $this->last_login_is_recent();
  }

  public function logout() {
    // unset both the session and the property
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    unset($_SESSION['last_login']);
    unset($_SESSION['user_level']);
    unset($this->user_id);
    unset($this->username);
    unset($this->last_login);
    unset($this->user_level);
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id =  $_SESSION['user_id'];
      $this->username =  $_SESSION['username'];
      $this->user_level =  $_SESSION['user_level'];
      $this->last_login =  $_SESSION['last_login'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif($this->last_login * self::MAX_LOGIN_AGE < time()) {
      return false; 
    } else {
      return true;
    }
  }

  public function message($msg="") {
    if(!empty($msg) ) {
      // this is a "set" message
      $_SESSION['message'] = $msg;
      return true;
    } else {
      // this is a "get" message
      return $_SESSION['message'];
    }
  }

/**
 * [verify_user_level description]
 *
 * @param   [type]  $user_level  [$user_level description]
 */
  static public function verify_user_level() {
    if($_SESSION['user_level'] == 'S') {
        
    } elseif($_SESSION['user_level'] == 'A') {
        
    } elseif($_SESSION['user_level'] == 'M') {
      redirect_to(url_for('/members/index.php'));
    } else {
      $errors[] = "Login was unsuccessful, please try again.";
    }
  }
    
/**
 * [verify_user_level description]
 *
 * @param   [type]  $user_level  [$user_level description]
 */
  static public function verify_super_admin_level() {
  if($_SESSION['user_level'] == 'S') {
    
  } elseif($_SESSION['user_level'] == 'A') {
    redirect_to(url_for('//index.php'));
  } elseif($_SESSION['user_level'] == 'M') {
    redirect_to(url_for('/members/index.php'));
  } else {
    $errors[] = "Login was unsuccessful, please try again.";
  }
  }
}

