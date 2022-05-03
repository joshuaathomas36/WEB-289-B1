<?php 
  require_once('../private/initialize.php');
  $page = 'Dinner';
  $page_title = 'Dinner';
  include(SHARED_PATH . '/header.php'); 
  $recipes = recipe::find_by_category(3);
?>

<div id="wrapper">
  <h2>Welcome to the Dinner Page</h2>

  <?php include(SHARED_PATH . '/recipes.php'); ?>

</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
