<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Replace Uploaded Image'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Replace Uploaded Image</h3>
    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/uploaded-image-editor/index.php'));
      }
      $id = $_GET['id'];

      $uploaded_image = uploadedimage::find_uploaded_image_by_id($id);
      if($uploaded_image == false) {
        redirect_to(url_for('/admins/uploaded-image-editor/index.php'));
      }

      if(is_post_request()) {
        $result = false;
        // Save record using post parameters
        $img_name = $_FILES['my_image']['name'] ?? '';
        $img_size = $_FILES['my_image']['size'] ?? '';
        $tmp_name = $_FILES['my_image']['tmp_name'] ?? '';
        $error = $_FILES['my_image']['error'] ?? '';

        if ($img_size > 125000) {
          $msg = "Sorry, your Image is too large of a file.";
        } else {
          $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
          $img_ex_lc = strtolower($img_ex);
          $allowed_exs = ['jpg', 'jpeg', 'png'];
    
          if (in_array($img_ex_lc, $allowed_exs)) {
            $new_image_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
            $image_upload_path = url_for('uploaded-images/' . $new_image_name);
            move_uploaded_file($tmp_name, $image_upload_path);

            $new_uploaded_image = new uploadedimage;
            $new_uploaded_image->replace_uploaded_image($uploaded_image->uploaded_image_id, $new_image_name);
            $result = true;
    
          } else {
            $msg = "Unable to submit recipe do to the following: This program does not support the $img_ex_lc file type. The supported file types are 'jpg', 'jpeg', and 'png'.";
          }
        }

        if($result === true) {
          $_SESSION['message'] = 'The new image has replace the old one successfully.';
          redirect_to(url_for('/admins/uploaded-image-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($uploaded_image->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/uploaded-image-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Replace Uploaded Image" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
