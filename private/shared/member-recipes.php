<div id="recipes">
    <?php foreach($recipes as $recipe) { ?>
      <a class="action" href="<?= url_for('/members/show.php?id=' . h(u($recipe->recipe_id))); ?>">
        <div class="recipe">
          <!-- uploaded_image Start -->
          <?php $uploaded_image = uploadedimage::find_by_recipe_id($recipe->recipe_id); ?>
          <img class="recipe-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">
          <!-- uploaded_image End -->

          <!-- subcategory Start -->
          <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id); ?>
          <?php foreach($subcategorys as $subcategory) { ?>
          <section class="sub"><?= h($subcategory->subcategory_name); ?></section>
          <?php } ?>
          <!-- subcategory End -->

          <!-- others Start -->
          <?php $reviews = review::find_sum_of_ratings_id($recipe->recipe_id); ?>
          <div class="rating"><?= $reviews->stars($reviews->ratings); ?></div>
          <p class="recipe-text"><?= h($recipe->name); ?></p>
          <p class="recipe-text"><?= h($recipe->cook_time); ?> Minutes</p>
          <!-- others End -->

          <!-- accounts buttons Start -->

          <!-- accounts buttons End -->
        </div>
      </a>
    <?php } ?>
  </div>