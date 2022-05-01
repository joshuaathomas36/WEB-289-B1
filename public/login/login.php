<?php
  require_once('../../private/initialize.php');

  $errors = [];
  $username = '';
  $pass = '';
  $password = '';
  $user_level = '';

  $attempts = $_SESSION['attempts'] ?? 0;
  $is_allowed = $_SESSION['is_allowed'] ?? 0;
  $msg = "";

  if($attempts >= 5 && $is_allowed == 0) {
    $msg = "You have failed to many times, please wait one hour before trying again.";
    $_SESSION['is_allowed'] = time();
  } elseif($attempts >= 5 && $is_allowed != 0) {
    $hour = 60 * 60;
    $time = $is_allowed + $hour;
    if($time >= time()) {
      $msg = "You have failed to many times, please wait before trying again.";
    } else {
      unset($_SESSION['attempts']);
      unset($_SESSION['is_allowed']);
      $attempts = 0;
    }
  } else {}

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
      // test if user is found and password is correct
      if($member != false && $member->verify_password($pass)) {
        // Mark admin as logged in
        $session->login($member);
        $user_level = $member->user_level;
        $msg = "You have successfully logged in!";
        $session->message($msg);
        unset($_SESSION['attempts']);
        $member->check_user_level($user_level);
      } else {
        // username not found or password does not match
        $errors[] = "No account found matching that username or password. " . $new_id . "";
        $attempts++;
        $_SESSION['attempts'] = $attempts;
      }
    }
  }
?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="wrapper">
  <div id="form">
    <h2>Log in</h2>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else { ?>
      <?= display_errors($errors);?>
    <?php } ?>
     
    <?php if(is_blank($msg)) { ?>
      <form action="" method="post">
        <label for="username">Username:</label><br>
        <input id="username" class="form-field" type="text" name="username" value="<?= h($username); ?>" required /><br>

        <label for="password">Password:</label><br>
        <input id="password" type="password" name="pass" value="<?= h($pass); ?>" required /><br>

        <input type="submit" name="submit" value="Submit" />
      </form>
    <?php } else {} ?>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
