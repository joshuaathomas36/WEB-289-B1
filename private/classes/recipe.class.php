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
    $this->approved = $args['approved'] ?? FALSE;
  }

  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  /**
   * find all approve recipes
   *
   * @return void
   */
  static public function find_recipes($boolean) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE approved='" . $boolean . "'";
    return static::find_by_sql($sql);
  }

  static public function instructions($jsonString) {
    $data = json_decode($jsonString);
    return $data;
  }

  static public function admin_instructions($jsonString) {
    $data = json_decode($jsonString, true);
    return $data;
  }

  static public function approved($boolean) {
    if($boolean == 1) {
      return 'Yes';
    } else {
      return 'No';
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

  static public function find_by_recipe_id_card($id) {
    $sql = "SELECT * FROM " . static::$table_name . " WHERE recipe_id='" . self::$database->escape_string($id) . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_recommended($id) {
    $sql = "SELECT * FROM `recipe` AS r LEFT JOIN `recommended` AS re ON ( r.recipe_id = re.recommended_recipe_id ) WHERE re.user_id='" . $id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_favorite($id) {
    $sql = "SELECT * FROM `recipe` AS r LEFT JOIN `favorite` AS f ON ( r.recipe_id = f.recipe_id ) WHERE f.user_id='" . $id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_meal_planner($id) {
    $sql = "SELECT * FROM `recipe` AS r LEFT JOIN `meal_planner` AS mp ON ( r.recipe_id = mp.recipe_id ) WHERE mp.user_id='" . $id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_name($name) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE name='" . self::$database->escape_string($name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function new_recipe($name, $cook_time, $instructions, $subcategory_id, $approved) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`name`, `cook_time`, `instructions`, `subcategory_id`, `approved`) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sisii", $name, $cook_time, $instructions, $subcategory_id, $approved);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function update_recipe($recipe_id, $name, $cook_time, $instructions, $subcategory_id) {
    $sql = self::$database->prepare("UPDATE " . static::$table_name . " SET name=?, cook_time=?, instructions=?, subcategory_id=? WHERE recipe_id=?");
    $sql->bind_param("sisii", $name, $cook_time, $instructions, $subcategory_id, $recipe_id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function Change_approved_status($id, $new_status) {
    $sql = self::$database->prepare("UPDATE " . static::$table_name . " SET approved=? WHERE recipe_id=?");
    $sql->bind_param("ii", $new_status, $id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }
  

  static public function delete_recipe($id, $image) {
    $sql = "DELETE FROM meal_planner WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $sql = "DELETE FROM favorite WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $sql = "DELETE FROM review WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $sql = "DELETE FROM recipe_ingredient WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $sql = "DELETE FROM recommended WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $path = 'uploaded-images/' . $image;
    unlink(url_for($path));
    $sql = "DELETE FROM uploaded_image WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    $sql = "DELETE FROM " . static::$table_name . " WHERE recipe_id='" . $id . "'";
    self::$database->query($sql);

    return true;
  }
}
