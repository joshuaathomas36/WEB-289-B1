<?php
require_once('../../private/initialize.php');
$page_title = "Foody's Delight: Member Menu";
include(SHARED_PATH . '/admin-header.php'); 
// require_login();
$members = member::find_all();
$session->verify_user_level();
?>

<!-- <h2>Main Menu</h2> -->
<table border="1">
<tr>
        <th>ID</th>
        <th>First</th>
        <th>Last</th>
        <th>Username</th>
        <th>Email</th>
        <th>User Level</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?= h($member->id); ?></td>
          <td><?= h($member->first_name); ?></td>
          <td><?= h($member->last_name); ?></td>
          <td><?= h($member->username); ?></td>
          <td><?= h($member->email); ?></td>
          <td><?= h($member->user_level); ?></td>
          <td><a class="action" href="<?= url_for('admins/show.php?id=' . h(u($member->id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/edit.php?id=' . h(u($member->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/delete.php?id=' . h(u($member->id))); ?>">Delete</a></td>
    <?php } ?>
</table>
<?php include(SHARED_PATH . '/footer.php'); ?>