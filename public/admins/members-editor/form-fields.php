<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($member)) {
  redirect_to(url_for('/admins/members-editor/index.php'));
}
$session->verify_user_level();

// if($session->user_level == 'S' && $member->user_level == 'S'){
//   redirect_to(url_for('/admins/members-editor/index.php'));
// } elseif($session->user_level == 'A' && $member->user_level != 'M'){
//   redirect_to(url_for('/admins/members-editor/index.php'));
// }
?>

<dl>
  <dt>First name</dt>
  <dd><input type="text" name="member[first_name]" value="<?= h($member->first_name); ?>" /></dd>
</dl>

<dl>
  <dt>Last name</dt>
  <dd><input type="text" name="member[last_name]" value="<?= h($member->last_name); ?>" /></dd>
</dl>

<dl>
  <dt>Email</dt>
  <dd><input type="text" name="member[email]" value="<?= h($member->email); ?>" /></dd>
</dl>

<dl>
  <dt>Username</dt>
  <dd><input type="text" name="member[username]" value="<?= h($member->username); ?>" /></dd>
</dl>

<dl>
  <dt>Password</dt>
  <dd><input type="password" name="member[password]" value="" /></dd>
</dl>

<dl>
  <dt>Confirm Password</dt>
  <dd><input type="password" name="member[confirm_password]" value="" /></dd>
</dl>
