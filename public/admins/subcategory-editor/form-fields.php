<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($subcategory)) {
    redirect_to(url_for('/admins/subcategory-editor/index.php'));
  }
  $session->verify_user_level();
  $current_category = category::find_category_by_id($subcategory->category_id);
?>

<label for="subcategory_name">Subcategory name</label><br>
<input id="subcategory_name" type="text" name="subcategory_name" value="<?= h($subcategory->subcategory_name); ?>" /><br>

<label for="category_name">Category</label><br>
<select id="category_name" name="category_id">
<?php if($current_category == false) { ?>
    <option value="0"></option>
  <?php } else { ?>
    <option value="<?= h($current_category->category_id); ?>"><?= h($current_category->category_name); ?></option>
  <?php
    }
    $categories = category::find_all();
    foreach($categories as $category) {
  ?>
    <option value="<?= h($category->category_id); ?>"><?= h($category->category_name); ?></option>
  <?php } ?>
</select><br>
