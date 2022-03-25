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

      $login = member::find_by_username($member->username);
      $session->login($login);
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

    <form action="" method="post">

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
    

      <div id="operations">
        <input type="submit" value="Sign up!" />
      </div>
    </form>
  </div>

  <?php include(SHARED_PATH . '/footer.php'); ?>
</div>
