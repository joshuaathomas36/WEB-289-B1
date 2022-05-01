<?php

class user extends databaseobject{

  static protected $table_name = 'site_user';
  static protected $db_columns = ['user_id', 'username', 'user_level', 'first_name', 'last_name', 'email'];

  public $user_id;
  public $username;
  public $user_level;
  public $first_name;
  public $last_name;
  public $email;

  public function __construct($args=[]) {
    $this->username = $args['username'] ?? '';
    $this->user_level = $args['user_level'] ?? '';
    $this->first_name = $args['first_name'] ?? '';
    $this->last_name = $args['last_name'] ?? '';
    $this->email = $args['email'] ?? '';
  }

  /**
   * Checks whether there were any input errors and displays the according error message if there were
   *
   * @return void
   */
  protected function validate() {
    $this->errors = [];
    if(is_blank($this->username)) {
      $this->errors[] = "username cannot be blank.";
    }
    if(is_blank($this->user_level)) {
      $this->errors[] = "user_level cannot be blank.";
    }
    return $this->errors;
  }
}
