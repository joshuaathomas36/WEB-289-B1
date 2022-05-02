<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Subcategory'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Subcategory</h3>
    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/subcategory-editor/index.php'));
      }
      $id = $_GET['id'];

      $subcategory = subcategory::find_by_subcategory_id($id);
      if($subcategory == false) {
        redirect_to(url_for('/admins/subcategory-editor/index.php'));
      }

      if(is_post_request()) {

        // Save record using post parameters
        $subcategory_name = strip_tags($_POST['subcategory_name']) ?? '';
        $category_id = $_POST['category_id'] ?? 0;
        $subcategory = new subcategory;
        $result = $subcategory->update_subcategory($id, $subcategory_name, $category_id);

        if($result === true) {
          $_SESSION['message'] = 'The subcategory was updated successfully.';
          redirect_to(url_for('/admins/subcategory-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($subcategory->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/subcategory-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Subcategory" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
