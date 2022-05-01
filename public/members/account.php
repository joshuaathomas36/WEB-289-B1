<?php 
  require_once('../../private/initialize.php');
  $page_title = 'Account';
  include(SHARED_PATH . '/member-header.php');
  include(SHARED_PATH . '/member-post.php');

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <h2>Welcome To Your Account</h2>
  <?php if($_SESSION['user_level'] != 'M') { ?>
    <p><a class="button" href="<?= url_for('/admins/index.php'); ?>">Admin's Area</a></p>
  <?php } ?>

  <?php if($_SESSION['user_level'] == 'S') { ?>
    <p><a class="button" href="<?= url_for('/super-admins/index.php'); ?>">Super Admin's Area</a></p>
  <?php } ?>

  <?php if(!is_blank($msg)) { ?>
    <p id="msg"><?= $msg; ?></p>
  <?php } else {} ?>

  <h3>Account Info.</h3>


  <h3>Your Meal Planner.</h3>
  <?php
    $recipes = recipe::find_by_meal_planner($session->user_id);
    include(SHARED_PATH . '/member-recipes.php');
  ?><br>

  <h3>Favorites.</h3>
  <?php
    $recipes = recipe::find_by_favorite($session->user_id);
    include(SHARED_PATH . '/member-recipes.php');
  ?><br>

  <h3>Recipes recommended to you!</h3>
  <?php
    $recipes = recipe::find_by_recommended($session->user_id);
    include(SHARED_PATH . '/member-recipes-recommend.php');
  ?>

</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
