<?php 
  require_once('../../private/initialize.php');
  $page = 'Breakfast';
  $page_title = 'Breakfast';
  include(SHARED_PATH . '/member-header.php');
  $recipes = recipe::find_by_category(1);
?>

<div id="wrapper">
  <h2>Here is Some Breakfast Recipes</h2>

  <?php include(SHARED_PATH . '/member-post.php'); ?>
  <?php include(SHARED_PATH . '/member-recipes.php'); ?>

  <?php  include(SHARED_PATH . '/footer.php'); ?>
</div>
