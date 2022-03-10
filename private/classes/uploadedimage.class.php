<?php

class uploadedimage extends databaseobject{

  static protected $table_name = 'uploaded_image';
  static protected $db_columns = ['uploaded_image_id', 'recipe_id', 'uploaded_image'];

  public $uploaded_image_id;
  public $recipe_id;
  public $uploaded_image;

  public function __construct($args=[]) {
    $this->uploaded_image_id = $args['uploaded_image_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->uploaded_image = $args['uploaded_image'] ?? '';
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
