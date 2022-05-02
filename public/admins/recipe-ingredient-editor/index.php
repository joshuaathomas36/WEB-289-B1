<?php
  require_once('../../../private/initialize.php');
  $page_title = "Recipe Ingredients editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $recipe_ingredients = recipe_ingredient::find_all();
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a class="back-link" href="../index.php">&laquo; Back to Main Menu</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <a class="action" href="<?= url_for('/admins/recipe-ingredient-editor/new.php'); ?>">Create New recipe ingredient</a>
    <table class="admin-table" border="1">
      <tr>
        <th>Recipe Ingredient ID</th>
        <th>Recipe</th>
        <th>Amount</th>
        <th>Measurement</th>
        <th>Ingredient</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php
        foreach($recipe_ingredients as $recipe_ingredient) {
          $recipe = recipe::find_by_recipe_id($recipe_ingredient->recipe_id);
          $ingredient = ingredient::find_ingredient_by_id($recipe_ingredient->ingredient_id);
          $measurement = measurement::find_measurement_by_id($recipe_ingredient->measurement_id);
      ?>
        <tr>
          <td><?= h($recipe_ingredient->recipe_ingredient_id); ?></td>
          <td><?= h($recipe->name); ?></td>
          <td><?= h($recipe_ingredient->amount); ?></td>
          <td><?= h($measurement->measurement); ?></td>
          <td><?= h($ingredient->ingredient_name); ?></td>
          <td><a class="action" href="<?= url_for('admins/recipe-ingredient-editor/show.php?id=' . h(u($recipe_ingredient->recipe_ingredient_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-ingredient-editor/edit.php?id=' . h(u($recipe_ingredient->recipe_ingredient_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-ingredient-editor/delete.php?id=' . h(u($recipe_ingredient->recipe_ingredient_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
