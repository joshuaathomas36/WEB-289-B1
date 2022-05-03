<?php
  require_once('../../../private/initialize.php');
  $page_title = "Review editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $reviews = review::find_all();
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a class="back-link" href="../index.php">&laquo; Back to Main Menu</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <table class="admin-table" border="1">
      <tr>
        <th>Review ID</th>
        <th>User</th>
        <th>Recipe</th>
        <th>Rating</th>
        <th>View</th>
        <th>Delete</th>
      </tr>

      <?php
        foreach($reviews as $review) {
          $member = member::find_by_id($review->user_id);
          $recipe = recipe::find_by_recipe_id($review->recipe_id);
      ?>
        <tr>
          <td><?= h($review->review_id); ?></td>
          <td><?= h($member->username); ?></td>
          <td><?= h($recipe->name); ?></td>
          <td><?= h($review->rating); ?></td>
          <td><a class="action" href="<?= url_for('admins/review-editor/show.php?id=' . h(u($review->review_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/review-editor/delete.php?id=' . h(u($review->review_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
