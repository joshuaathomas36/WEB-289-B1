<?php

class mealplanner extends databaseobject{

  static protected $table_name = 'meal_planner';
  static protected $db_columns = ['meal_planner_id', 'user_id', 'recipe_id'];

  public $meal_planner_id;
  public $user_id;
  public $recipe_id;

  public function __construct($args=[]) {
    $this->meal_planner_id = $args['meal_planner_id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
  }

  /**
   * find all approve recipes
   *
   * @return void
   */
  static public function is_meal_planned($user_id, $recipe_id) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recipe_id='" . $recipe_id . "'";
    return static::find_by_sql($sql);
  }

  static public function meal_planner_remove($user_id, $recipe_id) {
    $sql = "DELETE FROM " . static::$table_name . " WHERE user_id='" . $user_id . "' AND recipe_id='" . $recipe_id . "'";
    return self::$database->query($sql);
  }

  static public function meal_planner_add($user_id, $recipe_id) {
    $sql = "INSERT INTO " . static::$table_name . " (`user_id`, `recipe_id`) VALUES (" . $user_id . ", " . $recipe_id . ")";
    return self::$database->query($sql);
  }
}
