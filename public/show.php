<?php 
  require_once('../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  $page_title = '' . $recipe->name . '';
  include(SHARED_PATH . '/header.php'); 
?>

<div id="wrapper" class="show">
  <h2><?= h($recipe->name); ?></h2>

  <?php $uploaded_image = uploadedimage::find_by_recipe_id($recipe->recipe_id); ?>
  <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">

  <?php $reviews = review::find_sum_of_ratings_id($recipe->recipe_id); ?>
  <div class="show-rating"><?= $reviews->stars($reviews->ratings); ?></div>

  <h3>Cook Time</h3>
  <p><?= h($recipe->cook_time); ?></p>

  <h3>Ingredients</h3>
  <?php 
    $ingredients = ingredient::find_by_recipe_id($recipe->recipe_id);
    foreach($ingredients as $ingredient) { 
  ?>
    <p><?= h($ingredient->ingredient_name); ?></p>
  <?php } ?>

  <h3>Instructions</h3>
  <?php
    $steps = $recipe->instructions($recipe->instructions);
    $i = 1;
    foreach($steps as $step) { 
  ?>
    <p>Step <?= h($i++); ?> <?= h($step); ?></p>
  <?php } ?>

  

</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
