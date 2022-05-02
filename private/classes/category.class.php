<?php

class category extends databaseobject{

  static protected $table_name = 'category';
  static protected $db_columns = ['category_id', 'category_name'];

  public $category_id;
  public $category_name;

  public function __construct($args=[]) {
    $this->category_id = $args['category_id'] ?? '';
    $this->category_name = $args['category_name'] ?? '';
  }
  
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

  static public function find_category_by_id($id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_category_by_name($category_name) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE category_name='" . self::$database->escape_string($category_name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function new_category($category_name) {
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`category_name`) VALUES (?)");
    $sql->bind_param("s", $category_name);
    $sql->execute();
    $sql->close();
    return true;
  }

  static public function update_category($id, $category_name) {
    $sql = self::$database->prepare("UPDATE " . static::$table_name . " SET category_name=? WHERE category_id=?");
    $sql->bind_param("si", $category_name, $id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }

  static public function delete_category($id) {
    $new_category_id = 1;
    $sql = self::$database->prepare("UPDATE subcategory SET category_id=? WHERE category_id=?");
    $sql->bind_param("ii", $new_category_id, $id);
    $sql->execute();
    $sql->close();

    $sql = "DELETE FROM " . static::$table_name . " WHERE category_id='" . $id . "'";
    self::$database->query($sql);

    return true;
  }
}
