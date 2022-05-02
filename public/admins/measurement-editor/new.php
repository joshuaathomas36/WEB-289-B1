<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $new_measurement = strip_tags($_POST['measurement']);
    $measurement = new measurement;
    $result = $measurement->new_measurement($new_measurement);

    if($result === true) {
      $measurement = measurement::find_by_measurement_name($new_measurement);
      $new_id = $measurement->measurement_id;
      $_SESSION['message'] = 'The measurement was created successfully.';
      redirect_to(url_for('admins/measurement-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $measurement = new measurement;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Measurement'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Measurement</h1>

    <?=display_errors($measurement->errors); ?>

    <form action="<?=url_for('admins/measurement-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create measurement" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
