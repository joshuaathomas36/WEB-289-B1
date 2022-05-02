<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Subcategory'; 
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
        redirect_to(url_for('/admins/subcategory-editor/index.php'));
      }
      $id = $_GET['id'];
      $subcategory = subcategory::find_by_subcategory_id($id);
      if($subcategory == false) {
        redirect_to(url_for('/admins/subcategory-editor/index.php'));
      }

      if(is_post_request()) {

        // Delete admin
        $subcategory->delete_subcategory($id);
        $_SESSION['message'] = 'The subcategory was deleted successfully.';
        redirect_to(url_for('/admins/subcategory-editor/index.php'));

      } else {
    ?>
        <h1>Delete Subcategory</h1>
        <p>Are you sure you want to delete this Subcategory?</p>
        <h2>WARNING: This will change all recipes with this subcategory's id to 1.</h2>
        <p><?= h($subcategory->subcategory_name); ?></p>
        
        <form action="<?= url_for('/admins/subcategory-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Subcategory" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
