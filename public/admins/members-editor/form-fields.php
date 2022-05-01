<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($member)) {
    redirect_to(url_for('/admins/members-editor/index.php'));
  }
  $session->verify_user_level();
?>

<label for="first_name">First name</label><br>
<input id="first_name" type="text" name="member[first_name]" value="<?= h($member->first_name); ?>" /><br>

<label for="last_name">Last name</label><br>
<input id="last_name" type="text" name="member[last_name]" value="<?= h($member->last_name); ?>" /><br>

<label for="email">Email</label><br>
<input id="email" type="text" name="member[email]" value="<?= h($member->email); ?>" /><br>

<label for="username">Username</label><br>
<input id="username" type="text" name="member[username]" value="<?= h($member->username); ?>" /><br>

<label for="password">Password</label><br>
<input id="password" type="password" name="member[password]" value="" /><br>

<label for="confirm_password">Confirm Password</label><br>
<input id="confirm_password" type="password" name="member[confirm_password]" value="" /><br>
