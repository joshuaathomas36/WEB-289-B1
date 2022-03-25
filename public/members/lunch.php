<?php 
  require_once('../../private/initialize.php');
  $page = 'Lunch';
  $page_title = 'Lunch';
  include(SHARED_PATH . '/member-header.php'); 
  $recipes = recipe::find_by_category(2);
?>

<div id="wrapper">
  <h2>Here is Some Lunch Recipes</h2>
 
  <?php include(SHARED_PATH . '/member-post.php'); ?>
  <?php include(SHARED_PATH . '/member-recipes.php'); ?>
  
  <?php  include(SHARED_PATH . '/footer.php'); ?>
</div>
