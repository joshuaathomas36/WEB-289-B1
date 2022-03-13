  <div id="recipes">
    <?php foreach($recipes as $recipe) { ?>
      <?php $id = $recipe->recipe_id; ?>
      <a class="action" href="<?= url_for('/members/show.php?id=' . h(u($id))); ?>">
        <div class="recipe">

          <!-- uploaded_image Start -->
          <?php $uploaded_image = uploadedimage::find_by_recipe_id($id); ?>
          <img class="recipe-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">
          <!-- uploaded_image End -->

          <!-- subcategory Start -->
          <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id); ?>
          <?php foreach($subcategorys as $subcategory) { ?>
          <section class="sub"><?= h($subcategory->subcategory_name); ?></section>
          <?php } ?>
          <!-- subcategory End -->

          <!-- others Start -->
          <?php $reviews = review::find_sum_of_ratings_id($id); ?>
          <div class="rating"><?= $reviews->stars($reviews->ratings); ?></div>
          <p class="recipe-text"><?= h($recipe->name); ?></p>
          
          <form class="float" method="post">
          <input type="hidden" name="id" value="<?= $id ?>"  />
            <?php 
              $favorite = favorite::is_favorited($session->user_id, $id);
              if(!empty($favorite)) { 
            ?>
              <input type="submit" name="unfavorite" value="Unfavorite"  />
              <?php } else { ?>
              <input type="submit" name="favorite" value="Favorite"  />
            <?php } ?>
          </form>
          
          <p class="recipe-text"><?= h($recipe->cook_time); ?> Minutes</p>
          <!-- others End -->

          <!-- mp buttons Start -->
          <form method="post">
          <input type="hidden" name="id" value="<?= $id ?>"  />
            <?php 
              $mp = mealplanner::is_meal_planned($session->user_id, $id);
              if(!empty($mp)) { 
            ?>
              <input type="submit" name="Remove" value="Remove from meal planner"  />
              <?php } else { ?>
              <input type="submit" name="Add" value="Add to meal planner"  />
            <?php } ?>
          </form>
          <!-- mp buttons End -->

          <!-- remove recipe button Start -->
          <?php 
            $recommended = recommended::is_recommended($session->user_id, $id);
            foreach($recommended as $recommend) {
              $recommenders = $recommend->find_user($recommend->recommender_user_id);
              foreach($recommenders as $recommender) {
          ?>
                <p class="recommender">Recommended By: <?= $recommender->username; ?></p>
          <?php }} ?>
          <form method="post">
            <input type="hidden" name="id" value="<?= $id ?>"  />
            <input type="submit" name="removeRCD" value="Remove recommended"  />
          </form>
          <!-- remove recipe buttons End -->
        </div>
      </a>
    <?php } ?>
  </div>