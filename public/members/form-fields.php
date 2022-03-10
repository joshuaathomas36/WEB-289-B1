<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object


// if($session->user_level == 'S' && $member->user_level == 'S'){
//   redirect_to(url_for('/admins/members-editor/index.php'));
// } elseif($session->user_level == 'A' && $member->user_level != 'M'){
//   redirect_to(url_for('/admins/members-editor/index.php'));
// }
?>

<dl>
  <dt>Name</dt>
  <dd><input type="text" name="recipe[name]" value="<?= h($recipe->name); ?>" /></dd>
</dl>

<dl>
  <dt>Cook time</dt>
  <dd><input type="text" name="recipe[cook_time]" value="<?= h($recipe->cook_time); ?>" /></dd>
</dl>

<dl>
  <dt>Instructions</dt>
  <dd><input type="text" name="recipe[instructions]" value="<?= h($recipe->instructions); ?>" /></dd>
</dl>

<dl>
  <dt>Subcategory</dt>
  <dd><input type="text" name="recipe[subcategory_id]" value="<?= h($recipe->subcategory_id); ?>" /></dd>
</dl>
