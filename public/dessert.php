<?php 
  require_once('../private/initialize.php');
  $page = 'Dessert';
  $page_title = 'Dessert';
  include(SHARED_PATH . '/header.php');
  $recipes = recipe::find_by_category(4);
?>

<div id="wrapper">
  <h2>Welcome to Dessert Page</h2>

  <?php include(SHARED_PATH . '/recipes.php'); ?>

  <?php  include(SHARED_PATH . '/footer.php'); ?>
</div>
