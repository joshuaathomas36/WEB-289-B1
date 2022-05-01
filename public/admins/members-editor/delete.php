<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Member'; 
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
        redirect_to(url_for('/admins/members-editor/index.php'));
      }
      $id = $_GET['id'];
      $member = member::find_by_id($id);
      if($member == false) {
        redirect_to(url_for('/admins/members-editor/index.php'));
      }
      if($member->user_level != "M"){
        redirect_to('index.php');
      }

      if(is_post_request()) {

        // Delete admin
        $member->delete_user($id);
        $_SESSION['message'] = 'The user was deleted successfully.';
        redirect_to(url_for('/admins/members-editor/index.php'));

      } else {
    ?>
        <h1>Delete Member</h1>
        <p>Are you sure you want to delete this Member?</p>
        <p><?= h($member->full_name()); ?></p>
        
        <form action="<?= url_for('/admins/members-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Member" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
