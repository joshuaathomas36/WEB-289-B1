<?php
  require_once('../../../private/initialize.php');
  $page_title = "Measurement editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $measurements = measurement::find_all();
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

    <a class="action" href="<?= url_for('/admins/measurement-editor/new.php'); ?>">Create New measurement</a>
    <table class="admin-table" border="1">
      <tr>
        <th>Measurement ID</th>
        <th>Measurement</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php foreach($measurements as $measurement) { ?>
        <tr>
          <td><?= h($measurement->measurement_id); ?></td>
          <td><?= h($measurement->measurement); ?></td>
          <td><a class="action" href="<?= url_for('admins/measurement-editor/show.php?id=' . h(u($measurement->measurement_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/measurement-editor/edit.php?id=' . h(u($measurement->measurement_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/measurement-editor/delete.php?id=' . h(u($measurement->measurement_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
