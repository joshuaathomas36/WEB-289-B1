<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $review = review::find_review_by_id($id);
  if($review == false){
    redirect_to('index.php');
  }
  $member = member::find_by_id($review->user_id);
  $recipe = recipe::find_by_recipe_id($review->recipe_id);

  $page_title = 'Show Review';
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

    <h2>Review ID: <?= h($review->review_id); ?></h2>
    <h2>User: <?= h($member->username); ?></h2>
    <h2>Recipe: <?= h($recipe->name); ?></h2>
    <h2>Rating: <?= h($review->rating); ?></h2>
    <p><?= $review->stars($review->rating); ?></p>
    <h2>Review: </h2>
    <p><?= h($review->review); ?></p>

    <h2>Appearance: </h2>
    <div class="show">
      <div class="review">
        <p><?= h($member->username); ?></p>
        <div class="show-rating"><?= $review->stars($review->rating); ?></div>
        <?php if(!empty($review->review)) { ?>
          <p><?= h($review->review); ?></p>
        <?php } ?>
      </div>
    </div> <!-- End of appearance -->
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
