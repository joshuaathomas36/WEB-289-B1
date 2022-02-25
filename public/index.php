<?php 
require_once('../private/initialize.php');
$page_title = 'Is database connected checker';
include(SHARED_PATH . '/header.php'); 
?>

<p><a href="login/login.php">Log in</a> or <a href="login/signup.php">Become a Member</a></p>

<h2>Foody's Delight: Is database connected checker</h2>

    <table border="1">
      <tr>
        <th>Username</th>
        <th>User level</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
      </tr>

      <?php $users = user::find_all(); ?>

      <?php foreach($users as $user) { ?>
      <tr>
        <td><?=h($user->username); ?></td>
        <td><?=h($user->user_level); ?></td>
        <td><?=h($user->first_name); ?></td>
        <td><?=h($user->last_name); ?></td>
        <td><?=h($user->email); ?></td>
      </tr>
      <?php } ?>

    </table>

    <?php  include(SHARED_PATH . '/footer.php'); ?>
