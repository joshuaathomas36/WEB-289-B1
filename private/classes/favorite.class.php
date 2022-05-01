<?php

class favorite extends databaseobject{

  static protected $table_name = 'favorite';
  static protected $db_columns = ['favorite_id', 'user_id', 'recipe_id'];

  public $favorite_id;
  public $user_id;
  public $recipe_id;

  public function __construct($args=[]) {
    $this->favorite_id = $args['favorite_id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
  }

  static public function is_favorited($user_id, $recipe_id) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recipe_id='" . $recipe_id . "'";
    return static::find_by_sql($sql);
  }

  static public function favorite_remove($user_id, $recipe_id) {
    $sql = "DELETE FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recipe_id='" . $recipe_id . "'";
    return self::$database->query($sql);
  }

  static public function favorite_add($user_id, $recipe_id) {
    $sql = "INSERT INTO " . static::$table_name . " (`user_id`, `recipe_id`) VALUES (" . $user_id . ", " . $recipe_id . ")";
    return self::$database->query($sql);

    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`subcategory_name`, `category_id`) VALUES (?, ?)");
    $sql->bind_param("ii", $user_id, $recipe_id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }
}
