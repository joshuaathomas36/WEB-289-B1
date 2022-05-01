<?php

class recommended extends databaseobject{

  static protected $table_name = 'recommended';
  static protected $db_columns = ['recommended_id', 'recommender_user_id', 'user_id', 'recommended_recipe_id'];

  public $recommended_id;
  public $recommender_user_id;
  public $user_id;
  public $recommended_recipe_id;
  public $email;

  public function __construct($args=[]) {
    $this->recommended_id = $args['recommended_id'] ?? '';
    $this->recommender_user_id = $args['recommender_user_id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->recommended_recipe_id = $args['recommended_recipe_id'] ?? '';
    $this->email = $args['email'] ?? '';
  }

  static public function is_recommended($user_id, $recipe_id) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recommended_recipe_id='" . $recipe_id . "'";
    return static::find_by_sql($sql);
  }

  static public function recommended_remove($user_id, $recipe_id) {
    $sql = "DELETE FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recommended_recipe_id='" . $recipe_id . "'";
    return self::$database->query($sql);
  }

  static public function recommended_add($recommender_user_id, $user_id, $recipe_id) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`recommender_user_id`, `user_id`, `recommended_recipe_id`) VALUES (?, ?, ?)");
    $sql->bind_param("iii", $recommender_user_id, $user_id, $recipe_id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function find_user($user_id) {
    $sql = "SELECT email FROM site_user WHERE user_id='" . $user_id . "'";
    return static::find_by_sql($sql);
  }
}
