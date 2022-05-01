<?php 
  require_once('../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  if($recipe == false){
    redirect_to('index.php');
  }

  $page_title = '' . $recipe->name . '';
  include(SHARED_PATH . '/member-header.php');
  $id = $recipe->recipe_id;
  $rating = '';
  $review = '';

  $approved = $recipe->approved($recipe->approved);
  if($approved != "Yes"){
    redirect_to('index.php');
  }

  if(is_post_request()) {

    $rating = $_POST['rating'] ?? '';
    $review = strip_tags($_POST['review']) ?? '';
    $user_id = $session->user_id;

    if(!empty($rating)) {
      $new_review = new review;
      $new_review->review_add($user_id, $id, $rating, $review);
    } else {}
  }
?>

<div id="wrapper">
  <div class="show">
    <a class="button float" href="<?= url_for('members/recommendrecipe.php?id=' . h(u($id)));?>">Recommend This Recipe</a>
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
          $measurements = measurement::find_by_recipe_id($id, $ingredient->ingredient_id);
          foreach($measurements as $measurement) {
      ?>
        <p><?= h($measurement->amount); ?> <?= h($measurement->measurement); }?> <?= h($ingredient->ingredient_name); ?></p>
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
    <div class="review">
    <h4>Tried it? Why not leave a review!</h4>
      <form method="post">
        Rating:<br>
        <select name="rating">
          <?php 
            $is = array(5, 4, 3, 2, 1);
            foreach($is as $i) { 
          ?>
            <option value="<?= $i; ?>" class="show-rating"><?= $i; ?> Stars</option>
          <?php } ?>
          </select><br>

        Review:<br>
        <textarea name="review" value="<?= h($review); ?>"></textarea><br>
        <input type="submit" name="submit" value="Submit"  />
      </form>
    </div><br>
     
    <?php
      $reviews = review::find_all_reviews($id);
      foreach($reviews as $review) { 
        $user = member::find_username_by_id($review->user_id);
    ?>
      <div class="review">
        <p class="show-rating"><?= $reviews_rating->stars($reviews_rating->ratings); ?> <?= h($user->username); ?></p>
        <?php if(!empty($review->review)) { ?>
          <p><?= h($review->review); ?></p>
        <?php } else {} ?>
      </div>
    <?php } ?>
  </div>
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
