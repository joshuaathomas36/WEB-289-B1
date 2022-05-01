<?php

class recipe_ingredient extends databaseobject{

  static protected $table_name = 'recipe_ingredient';
  static protected $db_columns = ['recipe_ingredient_id', 'recipe_id', 'amount', 'measurement_id', 'ingredient_id'];

  public $recipe_ingredient_id;
  public $recipe_id;
  public $amount;
  public $measurement_id;
  public $ingredient_id;

  public function __construct($args=[]) {
    $this->recipe_ingredient_id = $args['recipe_ingredient_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->amount = $args['amount'] ?? '';
    $this->measurement_id = $args['measurement_id'] ?? '';
    $this->ingredient_id = $args['ingredient_id'] ?? '';
  }

  static public function find_all_recipe_ingredient() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function new_recipe_ingredient($recipe_id, $amount, $measurement_id, $ingredient_id) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`recipe_id`, `amount`, `measurement_id`, `ingredient_id`) VALUES (?, ?, ?, ?)");
    $sql->bind_param("iiii", $recipe_id, $amount, $measurement_id, $ingredient_id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }
}
