<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Measurement'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Measurement</h3>
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

        // Save record using post parameters
        $new_measurement = strip_tags($_POST['measurement']);
        $measurement = new measurement;
        $result = $measurement->update_measurement($id, $new_measurement);

        if($result === true) {
          $_SESSION['message'] = 'The measurement was updated successfully.';
          redirect_to(url_for('/admins/measurement-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($measurement->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/measurement-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Measurement" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
