<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Recipe'; 
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
        redirect_to(url_for('/admins/recipe-editor/index.php'));
      }
      $id = $_GET['id'];
      $recipe = recipe::find_by_recipe_id($id);
      if($recipe == false) {
        redirect_to(url_for('/admins/recipe-editor/index.php'));
      }

      if(is_post_request()) {

        // Delete admin
        $uploaded_image = uploadedimage::find_by_recipe_id($id);
        $recipe->delete_recipe($id, $uploaded_image->uploaded_image);
        $_SESSION['message'] = 'The recipe was deleted successfully.';
        redirect_to(url_for('/admins/recipe-editor/index.php'));

      } else { ?>
        <h1>Delete Recipe</h1>
        <p>Are you sure you want to delete this Recipe?</p>
        <h2>WARNING: This will remove all traces of this recipe and anything directly connected to it.</h2>
        <p><?= h($recipe->name); ?></p>
        
        
        <form action="<?= url_for('/admins/recipe-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="commit" value="Delete Recipe" />
        </form>
        
    <?php } ?>
  </div>
</div>
  


<?php include(SHARED_PATH . '/footer.php'); ?>
