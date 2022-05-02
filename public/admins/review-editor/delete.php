<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Review'; 
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/review-editor/index.php'));
      }
      $id = $_GET['id'];
      $review = review::find_review_by_id($id);
      if($review == false) {
        redirect_to(url_for('/admins/review-editor/index.php'));
      }
      $member = member::find_by_id($review->user_id);

      if(is_post_request()) {

        // Delete admin
        $review->delete_review($id);
        $_SESSION['message'] = 'The review was deleted successfully.';
        redirect_to(url_for('/admins/review-editor/index.php'));

      } else {
    ?>
        <h1>Delete Review</h1>
        <p>Are you sure you want to delete this review?</p>
        <div class="show">
          <div class="review">
            <p><?= h($member->username); ?></p>
            <div class="show-rating"><?= $review->stars($review->rating); ?></div>
            <?php if(!empty($review->review)) { ?>
              <p><?= h($review->review); ?></p>
            <?php } ?>
          </div>
        </div> <!-- End of appearance -->
        
        <form action="<?= url_for('/admins/review-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Review" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
