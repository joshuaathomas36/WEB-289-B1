<?php
  require_once('../../private/initialize.php');
  $msg = '';
  //include(SHARED_PATH . '/member-submitrecipe-post.php');
  $page_title = 'Submit a Recipe';
  include(SHARED_PATH . '/member-header.php');
?>

<div id="wrapper">
  <div id="form">
    <h2>Submit a Recipe</h2>

    <?php $recipe = new recipe; ?>
    <?php $subcategorys = subcategory::find_all_subcategory_names(); ?>
    <?= display_errors($recipe->errors); ?>
    <?= $msg; ?>

    <form method="post" enctype="multipart/form-data">
      <h3>Image</h3>
      <input type="file" name="my_image"><br>

      <h3>Subcategory</h3>
      <input type="text" name="subcategory" value="" list="subcategory" />
      <datalist id="subcategory">
        <option></option>
        <?php foreach($subcategorys as $subcategory) { ?>
        <option><?= h($subcategory->subcategory_name); ?></option>
        <?php } ?>
      </datalist><br>

      <h3>Name</h3>
      <input type="text" name="name" value="<?= h($recipe->name); ?>" /><br>

      <h3>Cook time</h3>
      <input type="number" name="cook_time" value="<?= h($recipe->cook_time); ?>" /><br>

      <h3>Ingredients</h3>
      <p>Not all boxes below have to be filled in. If the recipe requires more then fifteen ingredients please email the recipe.</p>

      <?php 
        $i = 1;
        while($i <= 15) {
      ?>
        <input type="text" name="ingredient<?= $i ?>" value="" list="ingredients" />
      <?php $i++; } ?>
      <datalist id="ingredients">
      <option></option>
      <?php
        $ingredients = ingredient::find_all_ingredient();
        foreach($ingredients as $ingredient) { 
      ?>
        <option><?= h($ingredient->ingredient_name); ?></option>
      <?php } ?>
      </datalist><br>

      <h3>Instructions</h3>
      <p>Not all boxes below have to be filled in. If the recipe requires more then five steps please email the recipe.</p>
      <h4>Step 1</h4>
      <textarea name="instructions1" value="<?= h($recipe->instructions); ?>"></textarea>
      <h4>Step 2</h4>
      <textarea name="instructions2" value="<?= h($recipe->instructions); ?>"></textarea>
      <h4>Step 3</h4>
      <textarea name="instructions3" value="<?= h($recipe->instructions); ?>"></textarea>
      <h4>Step 4</h4>
      <textarea name="instructions4" value="<?= h($recipe->instructions); ?>"></textarea>
      <h4>Step 5</h4>
      <textarea name="instructions5" value="<?= h($recipe->instructions); ?>"></textarea><br>

        <input type="submit" value="Submit Recipe" />
    </form>
  </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>
