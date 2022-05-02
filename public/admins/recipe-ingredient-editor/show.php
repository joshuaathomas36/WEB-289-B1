<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe_ingredient = recipe_ingredient::find_recipe_ingredient_by_id($id);
  if($recipe_ingredient == false){
    redirect_to('index.php');
  }

  $page_title = 'Show Recipe Ingredients';
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

    <?php
      $recipe = recipe::find_by_recipe_id($recipe_ingredient->recipe_id);
      $ingredient = ingredient::find_ingredient_by_id($recipe_ingredient->ingredient_id);
      $measurement = measurement::find_measurement_by_id($recipe_ingredient->measurement_id);
    ?>
    <h2>Recipe Ingredient ID: <?= h($recipe_ingredient->recipe_ingredient_id); ?></h2>
    <h2>Recipe: <?= h($recipe->name); ?></h2>
    <h2>Amount: <?= h($recipe_ingredient->amount); ?></h2>
    <h2>Measurement: <?= h($measurement->measurement); ?></h2>
    <h2>Ingredient: <?= h($ingredient->ingredient_name); ?></h2>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
