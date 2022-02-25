<?php
  require_once('../../private/initialize.php');
  $page_title = 'Edit Member'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

  <a class="back-link" href="<?= url_for('admins/index.php'); ?>">&laquo; Back to List</a>
<h3>Edit Member</h3>
<?php
  if(!isset($_GET['id'])) {
    redirect_to(url_for('/admins/index.php'));
  }
  $id = $_GET['id'];

  $member = member::find_by_id($id);
  if($member == false) {
    redirect_to(url_for('/admins/index.php'));
  }


  if(is_post_request()) {

    // Save record using post parameters
    $args = $_POST['member'];
    $member->merge_attributes($args);
    $result = $member->save();

    if($result === true) {
      $_SESSION['message'] = 'The member was updated successfully.';
      redirect_to(url_for('admins/show.php?id=' . $id));
    } else {
      // show errors
      display_errors($member->errors);
    }

  } else { ?>
  
    <form action="<?= url_for('admins/edit.php?id=' . h(u($id))); ?>" method="post">
      <?php include('form_fields.php'); ?>
      <input type="submit" value="Edit User" />
    </form>
  <?php } ?>

<?php include(SHARED_PATH . '/footer.php'); ?>
