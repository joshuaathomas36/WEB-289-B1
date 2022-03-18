<?php
require_once('../../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'];
  $member = new member($args);
  $result = $member->save();

  if($result === true) {
    $new_id = $member->id;
    $_SESSION['message'] = 'The your account was successfully created.';
    redirect_to(url_for('members/index.php'));
  } else {
    // show errors
  }

} else {
  // display the form
  $member = new member;
}
?>

<?php 
  $page_title = 'Sign up'; 
  include(SHARED_PATH . '/header.php'); 
?>

<div id="wrapper">
  <div id="form">
    <h2>Become a Member</h2>

    <?=display_errors($member->errors); ?>

    <form action="<?=url_for('login/signup.php'); ?>" method="post">

      <label for="email">First name</label>
      <input type="text" name="member[first_name]" value="<?= h($member->first_name); ?>" />

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

      <div id="operations">
        <input type="submit" value="Sign up!" />
      </div>
  </form>
</div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
