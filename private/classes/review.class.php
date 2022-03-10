<?php

class review extends databaseobject{

  static protected $table_name = 'review';
  static protected $db_columns = ['review_id', 'user_id', 'recipe_id', 'rating', 'review'];

  public $review_id;
  public $user_id;
  public $recipe_id;
  public $instructions;
  public $rating;
  public $review;

  public function __construct($args=[]) {
    $this->review_id = $args['review_id'] ?? '';
    $this->user_id = $args['user_id'] ?? '';
    $this->recipe_id = $args['recipe_id'] ?? '';
    $this->rating = $args['rating'] ?? '';
    $this->review = $args['review'] ?? '';
    $this->ratings = $args['ratings'] ?? '';
  }

      /**
   * find all approve recipes
   *
   * @return void
   */
  static public function find_all() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE approved='" . self::$database->escape_string($name) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_sum_of_ratings_id($id) {
    $sql = "SELECT AVG(rating) AS ratings FROM " . static::$table_name . " ";
    $sql .= "WHERE recipe_id='" . self::$database->escape_string($id) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function stars($amount) {
    if($amount == 5) {
      return '<img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt="">';
    } elseif($amount >= 4) {
      return '<img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt="">';
    } elseif($amount >= 3) {
      return '<img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt="">';
    } elseif($amount >= 2) {
      return '<img class="stars" src="uploaded-images/star.JPG" alt=""><img class="stars" src="uploaded-images/star.JPG" alt="">';
    } elseif($amount >= 1) {
      return '<img class="stars" src="uploaded-images/star.JPG" alt="">';
    } else {
      return false;
    }

  }

}
