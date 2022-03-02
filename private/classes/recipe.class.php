<?php

class recipe extends databaseobject{

  static protected $table_name = 'recipe';
  static protected $db_columns = ['recipe_id', 'name', 'cook_time', 'instructions', 'uploaded_image_id', 'subcategory_id', 'approved'];

  public $recipe_id;
  public $name;
  public $cook_time;
  public $instructions;
  public $uploaded_image_id;
  public $subcategory_id;
  public $approved

  public function __construct($args=[]) {
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->instructions = $args['instructions'] ?? '';
    $this->uploaded_image_id = $args['uploaded_image_id'] ?? '';
    $this->subcategory_id = $args['subcategory_id'] ?? '';
    $this->approved = $args['approved'] ?? '';
  }

      /**
   * find all approve recipes
   *
   * @return void
   */
  protected function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

}
