<?php 
require_once('../private/initialize.php');
$page = 'Lunch';
$page_title = 'Lunch';
include(SHARED_PATH . '/header.php'); 

$recipes = recipe::find_by_category(2);

?>

<div id="wrapper">
  <h2>Welcome to the Lunch Page</h2>

  <?php include(SHARED_PATH . '/recipes.php'); ?>

  <?php  include(SHARED_PATH . '/footer.php'); ?>
</div>
