<?php

class subcategory extends databaseobject{

  static protected $table_name = 'subcategory';
  static protected $db_columns = ['subcategory_id', 'subcategory_name', 'category_id'];

  public $subcategory_id;
  public $subcategory_name;
  public $category_id;

  public function __construct($args=[]) {
    $this->subcategory_id = $args['subcategory_id'] ?? '';
    $this->subcategory_name = $args['subcategory_name'] ?? '';
    $this->category_id = $args['category_id'] ?? '';
  }

  static public function find_all_subcategory_names() {
    $sql = "SELECT * FROM `subcategory`";
    return static::find_by_sql($sql);
  }

  static public function find_subcategory_name($sub_id) {
    $sql = "SELECT * FROM `subcategory` AS s RIGHT JOIN `recipe` AS r ON ( s.subcategory_id = r.subcategory_id ) WHERE s.subcategory_id='" . $sub_id . "'";
    return static::find_by_sql($sql);
  }

  static public function find_by_subcategory_name($sub_name) {
    $sql = "SELECT * FROM `subcategory` AS s RIGHT JOIN `recipe` AS r ON ( s.subcategory_id = r.subcategory_id ) WHERE s.subcategory_id='" . $sub_id . "'";
    return static::find_by_sql($sql);
  }

  static public function subcategory_add($subcategory_name) {
    $category_id = 1;
    $sql = self::$database->prepare("INSERT INTO " . static::$table_name . " (`subcategory_name`, `category_id`) VALUES (?, ?)");
    $sql->bind_param("si", $subcategory_name, $category_id);
    $sql->execute();
    $sql->close();
    return TRUE;
  }
}
