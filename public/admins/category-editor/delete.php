<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Category'; 
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

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

        // Delete admin
        $category->delete_category($id);
        $_SESSION['message'] = 'The category was deleted successfully.';
        redirect_to(url_for('/admins/category-editor/index.php'));

      } else {
    ?>
        <h1>Delete Category</h1>
        <p>Are you sure you want to delete this Category?</p>
        <h2>WARNING: This will change all subcategories with this category's id to 1.</h2>
        <p><?= h($category->category_name); ?></p>
        
        <form action="<?= url_for('/admins/category-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Category" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
