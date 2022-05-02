<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Category'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Category</h3>
    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/category-editor/index.php'));
      }
      $id = $_GET['id'];

      $category = category::find_category_by_id($id);
      if($category == false) {
        redirect_to(url_for('/admins/category-editor/index.php'));
      }

      if(is_post_request()) {

        // Save record using post parameters
        $category_name = strip_tags($_POST['category_name']);
        $category = new category;
        $result = $category->update_category($id, $category_name);

        if($result === true) {
          $_SESSION['message'] = 'The category was updated successfully.';
          redirect_to(url_for('/admins/category-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($category->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/category-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Category" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
