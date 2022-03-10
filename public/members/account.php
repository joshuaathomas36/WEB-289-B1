<?php 
require_once('../../private/initialize.php');
$page_title = 'Account';
include(SHARED_PATH . '/member-header.php'); 

$recipes1 = recipe::find_by_recommended($session->user_id);
$recipes2 = recipe::find_by_meal_planner($session->user_id);

?>

<div id="wrapper">
  <h2>Welcome To Your Account</h2>
  <h3>meal_planner</h3>
  <div id="recipes">
    <?php foreach($recipes2 as $recipe) { ?>
      <a class="action" href="<?= url_for('/show.php?id=' . h(u($recipe->recipe_id))); ?>">
        <div class="recipe">
          <!-- uploaded_image Start -->
          <?php $uploaded_image = uploadedimage::find_by_recipe_id($recipe->recipe_id); ?>
          <img class="recipe-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">
          <!-- uploaded_image End -->

          <!-- uploaded_image Start -->
          <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id); ?>
          <?php foreach($subcategorys as $subcategory) { ?>
          <section class="sub"><?= h($subcategory->subcategory_name); ?></section>
          <?php } ?>
          <!-- uploaded_image End -->

          <!-- Others Start -->
          <?php $reviews = review::find_sum_of_ratings_id($recipe->recipe_id); ?>
          <div class="rating"><?= $reviews->stars($reviews->ratings); ?></div>
          <p class="recipe-text"><?= h($recipe->name); ?></p>
          <p class="recipe-text"><?= h($recipe->cook_time); ?> Minutes</p>
          <!--Others End -->
        </div>
      </a>
    <?php } ?>
</div><br>

  <h3>Recipes recommended to you!</h3>
  <div id="recipes">
    <?php foreach($recipes1 as $recipe) { ?>
      <a class="action" href="<?= url_for('/members/show.php?id=' . h(u($recipe->recipe_id))); ?>">
        <div class="recipe">
          <!-- uploaded_image Start -->
          <?php $uploaded_image = uploadedimage::find_by_recipe_id($recipe->recipe_id); ?>
          <img class="recipe-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">
          <!-- uploaded_image End -->

          <!-- uploaded_image Start -->
          <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id); ?>
          <?php foreach($subcategorys as $subcategory) { ?>
          <section class="sub"><?= h($subcategory->subcategory_name); ?></section>
          <?php } ?>
          <!-- uploaded_image End -->

          <!-- Others Start -->
          <?php $reviews = review::find_sum_of_ratings_id($recipe->recipe_id); ?>
          <div class="rating"><?= $reviews->stars($reviews->ratings); ?></div>
          <p class="recipe-text"><?= h($recipe->name); ?></p>
          <p class="recipe-text"><?= h($recipe->cook_time); ?> Minutes</p>
          <!--Others End -->
        </div>
      </a>
    <?php } ?>
  </div>
</div>


<?php  include(SHARED_PATH . '/footer.php'); ?>
