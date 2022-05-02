<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $measurement = measurement::find_measurement_by_id($id);
  if($measurement == false){
    redirect_to('index.php');
  }

  $page_title = 'Show Measurement: ' . h($measurement->measurement);
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

    <h2>Measurement ID: <?= h($measurement->measurement_id); ?></h2>
    <h2>Measurement: <?= h($measurement->measurement); ?></h2>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
