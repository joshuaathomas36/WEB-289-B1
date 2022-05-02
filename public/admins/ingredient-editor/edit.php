<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Ingredient'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Ingredient</h3>
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

        // Save record using post parameters
        $ingredient_name = strip_tags($_POST['ingredient_name']);
        $ingredient = new ingredient;
        $result = $ingredient->update_ingredient($id, $ingredient_name);

        if($result === true) {
          $_SESSION['message'] = 'The ingredient was updated successfully.';
          redirect_to(url_for('/admins/ingredient-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($ingredient->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/ingredient-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Ingredient" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
