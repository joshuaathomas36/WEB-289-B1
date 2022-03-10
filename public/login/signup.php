<?php
require_once('../../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'];
  $member = new member($args);
  $result = $member->save();

  if($result === true) {
    $new_id = $member->id;
    $_SESSION['message'] = 'The member was created successfully.';
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
  <a href="<?=url_for('index.php'); ?>">&laquo; Go Back</a>

    <h1>Become a Member</h1>

    <?=display_errors($member->errors); ?>

    <form action="<?=url_for('login/signup.php'); ?>" method="post">

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

      <div id="operations">
        <input type="submit" value="Sign up!" />
      </div>
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
