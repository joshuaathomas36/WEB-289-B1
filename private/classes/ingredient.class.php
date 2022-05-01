<?php

class ingredient extends databaseobject{

  static protected $table_name = 'ingredient';
  static protected $db_columns = ['ingredient_id', 'ingredient_name'];

  public $ingredient_id;
  public $ingredient_name;

  public function __construct($args=[]) {
    $this->ingredient_id = $args['ingredient_id'] ?? '';
    $this->ingredient_name = $args['ingredient_name'] ?? '';
  }

  static public function find_all_ingredient() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function find_by_recipe_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " AS i RIGHT JOIN `recipe_ingredient` AS ri ON ( i.ingredient_id = ri.ingredient_id ) WHERE ri.recipe_id='" . $id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_ingredient_name($name) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE ingredient_name='" . $name . "'";
    return static::find_by_sql($sql);
  }

  static public function new_ingredient($name) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`ingredient_name`) VALUES (?)");
    $sql->bind_param("s", $name);
    $sql->execute();
    $sql->close();
    return TRUE;
  }
}
