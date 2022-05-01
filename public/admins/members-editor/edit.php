<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Member'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Member</h3>
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
        $args = $_POST['member'];
        $member->merge_attributes($args);
        $result = $member->save();

        if($result === true) {
          $_SESSION['message'] = 'The member was updated successfully.';
          redirect_to(url_for('/admins/members-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($member->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/members-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit User" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
