<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Measurement'; 
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
        redirect_to(url_for('/admins/measurement-editor/index.php'));
      }
      $id = $_GET['id'];
      $measurement = measurement::find_measurement_by_id($id);
      if($measurement == false) {
        redirect_to(url_for('/admins/measurement-editor/index.php'));
      }

      if(is_post_request()) {

        // Delete admin
        $measurement->delete_measurement($id);
        $_SESSION['message'] = 'The measurement was deleted successfully.';
        redirect_to(url_for('/admins/measurement-editor/index.php'));

      } else {
    ?>
        <h1>Delete Measurement</h1>
        <p>Are you sure you want to delete this measurement?</p>
        <h2>WARNING: This will change all recipe ingredients with this measurement's id to 1.</h2>
        <p><?= h($measurement->measurement); ?></p>
        
        <form action="<?= url_for('/admins/measurement-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Measurement" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
