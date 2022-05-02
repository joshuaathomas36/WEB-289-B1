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

  static public function find_all_measurement() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function find_by_measurement_name($measurement) {
    $sql = "SELECT * FROM `measurement` WHERE measurement='" . $measurement . "'";
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

  static public function find_measurement_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE measurement_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function new_measurement($name) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`measurement`) VALUES (?)");
    $sql->bind_param("s", $name);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function update_measurement($id, $measurement) {
    $sql = self::$database->prepare("UPDATE " . static::$table_name . " SET measurement=? WHERE measurement_id=?");
    $sql->bind_param("si", $measurement, $id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function delete_measurement($id) {
    $new_measurement_id = 1;
    $sql = self::$database->prepare("UPDATE recipe_ingredient SET measurement_id=? WHERE measurement_id=?");
    $sql->bind_param("ii", $new_measurement_id, $id);
    $sql->execute();
    $sql->close();

    $sql = "DELETE FROM " . static::$table_name . " WHERE measurement_id='" . $id . "'";
    self::$database->query($sql);
    return true;
  }
}
