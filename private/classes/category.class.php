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

      /**
   * find all approve recipes
   *
   * @return void
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . "";
    return static::find_by_sql($sql);
  }

}
