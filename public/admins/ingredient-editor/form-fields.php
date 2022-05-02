<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($ingredient)) {
    redirect_to(url_for('/admins/ingredient-editor/index.php'));
  }
  $session->verify_user_level();
?>

<label for="ingredient_name">Ingredient</label><br>
<input id="ingredient_name" type="text" name="ingredient_name" value="<?= h($ingredient->ingredient_name); ?>" /><br>
