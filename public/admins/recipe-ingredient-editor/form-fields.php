<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($recipe_ingredient)) {
    redirect_to(url_for('/admins/recipe-ingredient-editor/index.php'));
  }
  $session->verify_user_level();

  $recipes = recipe::find_all();
  $ingredients = ingredient::find_all();
  $measurements = measurement::find_all();
?>

<label for="recipe">Recipe</label><br>
<select id="recipe" name="recipe">
  <?php if(!empty($id)) { ?>
    <option value="<?= h($recipe->recipe_id); ?>"><?= h($recipe->name); ?></option>
  <?php } else { ?>
    <option value=""></option>
  <?php } ?>
  <?php foreach($recipes as $recipe) { ?>
      <option value="<?= h($recipe->recipe_id); ?>"><?= h($recipe->name); ?></option>
    <?php } ?>
</select><br>

<label for="amount">Amount</label><br>
<input id="amount" type="number" name="amount" value="<?= h($recipe_ingredient->amount); ?>" /><br>

<label for="measurement">Measurement</label><br>
<select id="measurement" name="measurement">
<?php if(!empty($id)) { ?>
  <option value="<?= h($measurement->measurement_id); ?>"><?= h($measurement->measurement); ?></option>
  <?php } else { ?>
    <option value=""></option>
  <?php } ?>
  <?php foreach($measurements as $measurement) { ?>
    <option value="<?= h($measurement->measurement_id); ?>"><?= h($measurement->measurement); ?></option>
  <?php } ?>
</select><br>

<label for="ingredient">Ingredient</label><br>
<select id="ingredient" name="ingredient">
  <?php if(!empty($id)) { ?>
    <option value="<?= h($ingredient->ingredient_id); ?>"><?= h($ingredient->ingredient_name); ?></option>
  <?php } else { ?>
    <option value=""></option>
  <?php } ?>
  <?php foreach($ingredients as $ingredient) { ?>
    <option value="<?= h($ingredient->ingredient_id); ?>"><?= h($ingredient->ingredient_name); ?></option>
  <?php } ?>
</select><br>
