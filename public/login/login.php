<?php
require_once('../../private/initialize.php');

$errors = [];
$username = '';
$pass = '';
$password = '';
$user_level = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $pass = $_POST['pass'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($pass)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $member = member::find_by_username($username);
    // test if admin found and password is correct
    if($member != false && $member->verify_password($pass)) {
      // Mark admin as logged in
      // Review this line
      $session->login($member);
      $user_level = $member->user_level;
      $member->check_user_level($user_level);
    } else {
      // username not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }
  }
}
?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="wrapper">
  <div id="form">
    <h2>Log in</h2>

    <?= display_errors($errors); ?>

    <form action="login.php" method="post">
      Username:<br>
      <input class="form-field" type="text" name="username" value="<?= h($username); ?>" /><br />
      Password:<br>
      <input type="password" name="pass" value="<?= h($pass); ?>" /><br>
      <input type="submit" name="submit" value="Submit"  />
    </form>

  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
