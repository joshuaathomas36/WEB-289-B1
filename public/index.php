<?php 
  require_once('../private/initialize.php');
  $page = 'Home';
  $page_title = 'Homepage';
  include(SHARED_PATH . '/header.php'); 
  $recipes = recipe::find_recipes(TRUE);
?>

<div id="wrapper">
  <h2>Welcome to Foody's Delight Recipes</h2>

  <?php include(SHARED_PATH . '/recipes.php'); ?>

</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
