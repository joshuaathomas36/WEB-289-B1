<?php 
  require_once('../../private/initialize.php');
  $page = 'Dessert';
  $page_title = 'Dessert';
  include(SHARED_PATH . '/member-header.php'); 
  $recipes = recipe::find_by_category(4);
?>

<div id="wrapper">
  <h2>Here are Some Dessert Recipes</h2>

  <?php include(SHARED_PATH . '/member-post.php'); ?>
  <?php include(SHARED_PATH . '/member-recipes.php'); ?>
  
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
