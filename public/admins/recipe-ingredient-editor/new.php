<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $recipe_id = $_POST['recipe'];
    $amount = $_POST['amount'];
    $measurement_id = $_POST['measurement'];
    $ingredient_id = $_POST['ingredient'];

    $recipe_ingredient = new recipe_ingredient;
    $result = $recipe_ingredient->new_recipe_ingredient($recipe_id, $amount, $measurement_id, $ingredient_id);

    if($result === true) {
      $_SESSION['message'] = 'The recipe ingredient was created successfully.';
      redirect_to(url_for('admins/recipe-ingredient-editor/index.php'));
    } else {
      // show errors
    }

  } else {
    // display the form
    $recipe_ingredient = new recipe_ingredient;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Recipe Ingredient'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Recipe Ingredient</h1>

    <?=display_errors($recipe_ingredient->errors); ?>

    <form action="<?=url_for('admins/recipe-ingredient-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create recipe ingredient" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
