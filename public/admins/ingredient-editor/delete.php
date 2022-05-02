<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Ingredient'; 
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
        redirect_to(url_for('/admins/ingredient-editor/index.php'));
      }
      $id = $_GET['id'];
      $ingredient = ingredient::find_ingredient_by_id($id);
      if($ingredient == false) {
        redirect_to(url_for('/admins/ingredient-editor/index.php'));
      }

      if(is_post_request()) {

        // Delete admin
        $ingredient->delete_ingredient($id);
        $_SESSION['message'] = 'The ingredient was deleted successfully.';
        redirect_to(url_for('/admins/ingredient-editor/index.php'));

      } else {
    ?>
        <h1>Delete Ingredient</h1>
        <p>Are you sure you want to delete this ingredient?</p>
        <h2>WARNING: This will change all recipe ingredients with this ingredient's id to 1.</h2>
        <p><?= h($ingredient->ingredient_name); ?></p>
        
        <form action="<?= url_for('/admins/ingredient-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Ingredient" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
