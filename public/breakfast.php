<?php 
require_once('../private/initialize.php');
$page = 'Breakfast';
$page_title = 'Breakfast';
include(SHARED_PATH . '/header.php'); 

$recipes = recipe::find_by_category(1);

?>

<div id="wrapper">
  <h2>Welcome to Foody's Delight</h2>

  <?php include(SHARED_PATH . '/recipes.php'); ?>
  
</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
