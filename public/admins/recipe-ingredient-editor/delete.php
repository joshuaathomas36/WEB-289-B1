<?php

  require_once('../../../private/initialize.php');

  $page_title = 'Delete Recipe Ingredient'; 
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

        // Delete admin
        $recipe_ingredient->delete_recipe_ingredient($id);
        $_SESSION['message'] = 'The recipe ingredient was deleted successfully.';
        redirect_to(url_for('/admins/recipe-ingredient-editor/index.php'));

      } else {
    ?>
        <h1>Delete Recipe Ingredient</h1>
        <p>Are you sure you want to delete this ingredient from the <?= $recipe->name ?> recipe?</p>
        <p><?= h($recipe_ingredient->amount); ?> <?= h($measurement->measurement); ?> <?= h($ingredient->ingredient_name); ?></p>
        
        <form action="<?= url_for('/admins/recipe-ingredient-editor/delete.php?id=' . h(u($id))); ?>" method="post">
            <input type="submit" name="submit" value="Delete Recipe Ingredient" />
        </form>
      
    <?php } ?>
  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
