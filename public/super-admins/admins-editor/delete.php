<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Member'; 
  include(SHARED_PATH . '/super-admins-header.php'); 
  $session->verify_user_level();
?>

  <a class="back-link" href="index.php">&laquo; Back to List</a>

<?php
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/super-admins/admins-editor/index.php'));
  }
  $id = $_GET['id'];
  $member = member::find_by_id($id);
  if($member == false) {
    redirect_to(url_for('/super-admins/admins-editor/index.php'));
  }

  if(is_post_request()) {

    // Delete admin
    $result = $member->delete();
    $_SESSION['message'] = 'The user was deleted successfully.';
    redirect_to(url_for('/super-admins/admins-editor/index.php'));

  } else { ?>
    <h1>Delete Member</h1>
    <p>Are you sure you want to delete this Member?</p>
    <p><?= h($member->full_name()); ?></p>
    
    <form action="<?= url_for('/super-admins/admins-editor/delete.php?id=' . h(u($id))); ?>" method="post">
        <input type="submit" name="commit" value="Delete Member" />
    </form>
    
  <?php } ?>

  


<?php include(SHARED_PATH . '/footer.php'); ?>
