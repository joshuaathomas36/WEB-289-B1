<?php

class measurement extends databaseobject{

  static protected $table_name = 'measurement';
  static protected $db_columns = ['measurement_id', 'measurement'];

  public $measurement_id;
  public $measurement;
  public $amount;

  public function __construct($args=[]) {
    $this->measurement_id = $args['measurement_id'] ?? '';
    $this->measurement = $args['measurement'] ?? '';
    $this->amount = $args['amount'] ?? '';
  }

  /**
   * find all approve recipes
   *
   * @return void
   */
  static public function find_all_measurement() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function find_by_recipe_id($id, $ingredient_id) {
    $sql = "SELECT * FROM " . static::$table_name . " AS m RIGHT JOIN `recipe_ingredient` AS ri ON ( m.measurement_id = ri.measurement_id ) WHERE ri.recipe_id='" . $id . "' AND ri.ingredient_id='" . $ingredient_id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_amount($id, $ingredient_id) {
    $sql = "SELECT amount FROM `recipe_ingredient` WHERE ri.recipe_id='" . $id . "' AND ri.ingredient_id='" . $ingredient_id . "'";
    return static::find_by_sql($sql);
  }
}
