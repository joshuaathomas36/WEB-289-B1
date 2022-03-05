<?php

class recipe extends databaseobject{

  static protected $table_name = 'recipe';
  static protected $db_columns = ['recipe_id', 'name', 'cook_time', 'instructions', 'subcategory_id', 'approved'];

  public $recipe_id;
  public $name;
  public $cook_time;
  public $instructions;
  public $subcategory_id;
  public $approved;

  public function __construct($args=[]) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->cook_time = $args['cook_time'] ?? '';
    $this->instructions = $args['instructions'] ?? '';
    $this->subcategory_id = $args['subcategory_id'] ?? '';
    $this->approved = $args['approved'] ?? '';
  }

  /**
   * find all approve recipes
   *
   * @return void
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function find_recipes($boolean) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE approved='" . $boolean . "'";
    return static::find_by_sql($sql);
  }

  static public function instructions($jsonString) {
    $data = json_decode($jsonString);
    return $data;
  }

  static public function approved($boolean) {
    if($boolean == 1) {
      return "Yes";
    } else {
      return "No";
    }
  }

  static public function find_by_category($cat_id) {
    $sql = "SELECT * FROM `recipe` AS r LEFT JOIN `subcategory` AS s ON ( r.subcategory_id = s.subcategory_id ) WHERE s.category_id='" . $cat_id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_recipe_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }
}
