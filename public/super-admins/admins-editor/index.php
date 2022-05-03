<?php
  require_once('../../../private/initialize.php');
  $page_title = "Foody's Delight: Members editor";
  include(SHARED_PATH . '/super-admin-header.php'); 
  $members = member::find_admins();
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

    <a class="action" href="<?= url_for('/super-admins/admins-editor/new.php'); ?>">Create New Admin</a>
    <table class="admin-table" border="1">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>User Level</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?= h($member->user_id); ?></td>
          <td><?= h($member->username); ?></td>
          <td><?= h($member->email); ?></td>
          <td><?= h($member->user_level); ?></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/show.php?id=' . h(u($member->user_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/edit.php?id=' . h(u($member->user_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/delete.php?id=' . h(u($member->user_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
