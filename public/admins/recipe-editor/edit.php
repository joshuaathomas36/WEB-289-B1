<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Recipe'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
  $result = '';
  $errors = [];
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h3>Edit Recipe</h3>
    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/recipe-editor/index.php'));
      }
      $id = $_GET['id'];

      $recipe = recipe::find_by_recipe_id($id);
      if($recipe == false) {
        redirect_to(url_for('/admins/recipe-editor/index.php'));
      }

      include(SHARED_PATH . '/admin-update-recipe-post.php');

      if($result === true) {
        $_SESSION['message'] = 'The recipe was updated successfully.';
        redirect_to(url_for('/admins/recipe-editor/show.php?id=' . $id));
      } else {
        // show errors
        display_errors($errors);
      }
    ?>
      
      <form action="<?= url_for('/admins/recipe-editor/edit.php?id=' . h(u($id))); ?>" method="post" enctype="multipart/form-data">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Recipe" />
      </form>
  </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>
