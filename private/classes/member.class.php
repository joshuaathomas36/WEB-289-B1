<?php

class member extends databaseobject {

  static protected $table_name = "site_user";
  static protected $db_columns = ['user_id', 'username', 'password', 'user_level', 'first_name', 'last_name', 'email'];

  public $user_id;
  public $first_name;
  public $last_name;
  public $user_level;
  public $email;
  public $username;
  protected $hashed_password;
  public $password;
  public $confirm_password;
  protected $password_required = true;

  public function __construct($args=[]) {
    $this->user_id = $args['user_id'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->user_level = $args['user_level'] ?? 'M';
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->confirm_password = $args['confirm_password'] ?? '';
  }

  public function full_name() {
    return $this->first_name . " " . $this->last_name;
  }

  protected function set_hashed_password() {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($pass) {
    return password_verify($pass, $this->password);
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hashed_password();
      // validate the password
    } else {
      // password not being updated - skip hashing and validation
      $this->password_required = false;
    }
    return parent::update();
  }

  // validate method for Admin class
  protected function validate() {
    $this->errors = [];

    if(is_blank($this->first_name)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->first_name, array('min' => 2, 'max' => 50))) {
      $this->errors[] = "First name must be between 2 and 50 characters. If it is longer please use a shorten version";
    }

    if(is_blank($this->last_name)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->last_name, array('min' => 2, 'max' => 50))) {
      $this->errors[] = "Last name must be between 2 and 50 characters. If it is longer please use a shorten version";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 100))) {
      $this->errors[] = "Email must be less than 100 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->errors[] = "Email is already in use, If you already have an account please use that one. If this is your email but you don't have an account please email us about the issue.";
    }

    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "Username not allowed. Try another.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
  }

  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_username_by_id($id) {
    $sql = "SELECT username FROM " . static::$table_name . " ";
    $sql .= "WHERE user_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  /**
   * The check_user_level method checks the user level, then directs where the user goes based on that.
   *
   * @param   [type]  $user_level  The user level
   */
  static public function check_user_level($user_level) {
    if($user_level == 'S') {
      redirect_to(url_for('/super-admins/index.php'));
    } elseif($user_level == 'A') {
      redirect_to(url_for('/admins/index.php'));
    } elseif($user_level == 'M') {
      redirect_to(url_for('/members/account.php'));
    } else {
      $errors[] = "Login was unsuccessful, please try again.";
    }
  }

}
