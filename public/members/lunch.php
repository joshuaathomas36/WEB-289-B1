<?php 
require_once('../../private/initialize.php');
$page = 'Lunch';
$page_title = 'Lunch';
include(SHARED_PATH . '/member-header.php'); 

$recipes = recipe::find_by_category(2);
?>

<div id="wrapper">
  <h2>Welcome to Lunch page <?= $session->username; ?></h2>
 

  <?php include(SHARED_PATH . '/member-recipes.php'); ?>
  
</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
