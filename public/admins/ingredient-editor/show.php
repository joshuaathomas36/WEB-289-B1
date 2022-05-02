<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $ingredient = ingredient::find_ingredient_by_id($id);
  if($ingredient == false){
    redirect_to('index.php');
  }

  $page_title = 'Show Ingredient: ' . h($ingredient->ingredient_name);
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <h2>Ingredient ID: <?= h($ingredient->ingredient_id); ?></h2>
    <h2>Ingredient: <?= h($ingredient->ingredient_name); ?></h2>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
