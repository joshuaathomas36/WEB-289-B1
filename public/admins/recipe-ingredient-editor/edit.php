<?php
  require_once('../../../private/initialize.php');
  $page_title = 'Edit Recipe Ingredient'; 
  include(SHARED_PATH . '/admin-header.php');
  $session->verify_user_level();
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>
    <h3>Edit Recipe Ingredient</h3>
    <?php
      if(!isset($_GET['id'])) {
        redirect_to(url_for('/admins/recipe-ingredient-editor/index.php'));
      }
      $id = $_GET['id'];

      $recipe_ingredient = recipe_ingredient::find_recipe_ingredient_by_id($id);
      if($recipe_ingredient == false) {
        redirect_to(url_for('/admins/recipe-ingredient-editor/index.php'));
      }
      $recipe = recipe::find_by_recipe_id($recipe_ingredient->recipe_id);
      $ingredient = ingredient::find_ingredient_by_id($recipe_ingredient->ingredient_id);
      $measurement = measurement::find_measurement_by_id($recipe_ingredient->measurement_id);

      if(is_post_request()) {

        // Save record using post parameters
        $recipe_id = $_POST['recipe'];
        $amount = $_POST['amount'];
        $measurement_id = $_POST['measurement'];
        $ingredient_id = $_POST['ingredient'];

        $recipe_ingredient = new recipe_ingredient;
        $result = $recipe_ingredient->update_recipe_ingredient($id, $recipe_id, $amount, $measurement_id, $ingredient_id);

        if($result === true) {
          $_SESSION['message'] = 'The ingredient was updated successfully.';
          redirect_to(url_for('/admins/recipe-ingredient-editor/show.php?id=' . $id));
        } else {
          // show errors
          display_errors($ingredient->errors);
        }

      } else {
    ?>
      
      <form action="<?= url_for('/admins/recipe-ingredient-editor/edit.php?id=' . h(u($id))); ?>" method="post">
        <?php include('form-fields.php'); ?>
        <input type="submit" value="Edit Recipe Ingredient" />
      </form>
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
