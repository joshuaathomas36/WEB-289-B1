<?php 
  require_once('../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  $page_title = '' . $recipe->name . '';
  include(SHARED_PATH . '/header.php'); 
  $id = $recipe->recipe_id;
?>

<div id="wrapper">
  <div class="show">
    <h2><?= h($recipe->name); ?></h2>

    <?php $uploaded_image = uploadedimage::find_by_recipe_id($id); ?>
    <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">

    <?php $reviews_rating = review::find_sum_of_ratings_id($id); ?>
    <div class="show-rating"><?= $reviews_rating->stars($reviews_rating->ratings); ?></div>

    <h3>Cook Time</h3>
    <p><?= h($recipe->cook_time); ?></p>

    <h3>Ingredients you will need</h3>
    <?php 
      $ingredients = ingredient::find_by_recipe_id($id);
      foreach($ingredients as $ingredient) { 
        $amounts = $measurements = measurement::find_by_recipe_id($id, $ingredient->ingredient_id);
        $measurements = measurement::find_by_recipe_id($id, $ingredient->ingredient_id);
        foreach($measurements as $measurement) {
          foreach($amounts as $amount) {
    ?>
            <p><?= h($amount->amount); } ?> <?= h($measurement->measurement); }?> <?= h($ingredient->ingredient_name); ?></p>
    <?php } ?>

    <h3>Instructions</h3>
    <?php
      $steps = $recipe->instructions($recipe->instructions);
      $i = 1;
      foreach($steps as $step) { 
    ?>
      <h4>Step <?= h($i++); ?></h4>
      <p><?= h($step); ?></p>
    <?php } ?>

    <h3>Reviews</h3>
    <?php
      $reviews = review::find_all_reviews($id);
      foreach($reviews as $review) { 
        $user = member::find_username_by_id($review->user_id);
    ?>
      <div class="review">
        <p><?= h($user->username); ?></p>
        <div class="show-rating"><?= $reviews_rating->stars($reviews_rating->ratings); ?></div>
        <?php if(!empty($review->review)) { ?>
          <p><?= h($review->review); ?></p>
        <?php } else {} ?>
      </div>
    <?php } ?>
  </div>
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
