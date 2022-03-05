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

  static public function find_subcategory_name($sub_id) {
    $sql = "SELECT * FROM `subcategory` AS s RIGHT JOIN `recipe` AS r ON ( s.subcategory_id = r.subcategory_id ) WHERE s.subcategory_id='" . $sub_id . "'";
    return static::find_by_sql($sql);
  }
}