<?php
require_once('../../../private/initialize.php');
$page_title = "Foody's Delight: Members editor";
include(SHARED_PATH . '/admin-header.php'); 
// require_login();
$members = member::find_admins();
$session->verify_user_level();
?>

<a class="back-link" href="../index.php">&laquo; Back to Main Menu</a>

<a class="action" href="<?= url_for('/super-admins/admins-editor/new.php'); ?>">Create New Admin</a>
<table border="1">
<tr>
        <th>First</th>
        <th>Last</th>
        <th>Username</th>
        <th>Email</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?= h($member->first_name); ?></td>
          <td><?= h($member->last_name); ?></td>
          <td><?= h($member->username); ?></td>
          <td><?= h($member->email); ?></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/show.php?id=' . h(u($member->user_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/edit.php?id=' . h(u($member->user_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('super-admins/admins-editor/delete.php?id=' . h(u($member->user_id))); ?>">Delete</a></td>
    <?php } ?>
</table>
<?php include(SHARED_PATH . '/footer.php'); ?>