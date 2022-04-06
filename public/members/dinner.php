<?php 
  require_once('../../private/initialize.php');
  $page = 'Dinner';
  $page_title = 'Dinner';
  include(SHARED_PATH . '/member-header.php'); 
  $recipes = recipe::find_by_category(3);
?>

<div id="wrapper">
  <h2>Here are Some Dinner Recipes</h2>

  <?php include(SHARED_PATH . '/member-post.php'); ?>
  <?php include(SHARED_PATH . '/member-recipes.php'); ?>
  
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
