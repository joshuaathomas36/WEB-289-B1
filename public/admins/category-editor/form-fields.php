<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($category)) {
    redirect_to(url_for('/admins/category-editor/index.php'));
  }
  $session->verify_user_level();
?>

<label for="category_name">Category name</label><br>
<input id="category_name" type="text" name="category_name" value="<?= h($category->category_name); ?>" /><br>
