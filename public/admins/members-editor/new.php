<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $args = $_POST['member'];
    $member = new member($args);
    $result = $member->save();

    if($result === true) {
      $new_id = $member->id;
      $_SESSION['message'] = 'The member was created successfully.';
      redirect_to(url_for('admins/members-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $member = new member;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Member'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Member</h1>

    <?=display_errors($member->errors); ?>

    <form action="<?=url_for('admins/members-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create member" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
