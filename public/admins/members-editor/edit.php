<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Member'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
  $errors = [];
?>

<?php
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/admins/members-editor/index.php'));
  }
  $id = $_GET['id'];

  $member = member::find_by_id($id);
  if($member == false) {
    redirect_to(url_for('/admins/members-editor/index.php'));
  }
  if($member->user_level != "M"){
    redirect_to('index.php');
  }

  if(is_post_request()) {

    // Save record using post parameters
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_level = 'M';
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($password === $confirm_password) {
      $password = $member->create_hashed_password($password);
      $result = $member->update_user($id, $username, $password, $user_level, $first_name, $last_name, $email);
    }
    
    if($result == true) {
      $_SESSION['message'] = 'The member was updated successfully.';
      redirect_to(url_for('/admins/members-editor/show.php?id=' . $id));
    } else {
      // show errors
      display_errors($errors);
    }
  }
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Member</h3>
      
    <form action="<?= url_for('/admins/members-editor/edit.php?id=' . h(u($id))); ?>" method="post">
      <label for="first_name">First name</label><br>
      <input id="first_name" type="text" name="first_name" value="<?= h($member->first_name); ?>" /><br>

      <label for="last_name">Last name</label><br>
      <input id="last_name" type="text" name="last_name" value="<?= h($member->last_name); ?>" /><br>

      <label for="email">Email</label><br>
      <input id="email" type="text" name="email" value="<?= h($member->email); ?>" /><br>

      <label for="username">Username</label><br>
      <input id="username" type="text" name="username" value="<?= h($member->username); ?>" /><br>

      <label for="password">Password</label><br>
      <input id="password" type="password" name="password" value="" /><br>

      <label for="confirm_password">Confirm Password</label><br>
      <input id="confirm_password" type="password" name="confirm_password" value="" /><br>
      <input type="submit" value="Edit User" />
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
