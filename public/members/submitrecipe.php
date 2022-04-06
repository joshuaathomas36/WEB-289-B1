<?php
  require_once('../../private/initialize.php');
  $msg = '';
  //include(SHARED_PATH . '/member-submitrecipe-post.php');
  $page_title = 'Submit a Recipe';
  include(SHARED_PATH . '/member-header.php');
?>

<div id="wrapper">
  <div id="form">
    <?= $msg ?>
    <h2>Submit a Recipe</h2>
    <h3>Currently not available</h3>

    <?php $recipe = new recipe; ?>
    <?php $subcategorys = subcategory::find_all_subcategory_names(); ?>
    <?= display_errors($recipe->errors); ?>
    <?= $msg; ?>

    <form method="post" enctype="multipart/form-data">
      <label for="image">Image</label><br>
      <input id="image" type="file" name="my_image"><br>

      <label for="subcategory">Subcategory</label><br>
      <input id="subcategory" type="text" name="subcategory" value="" list="subcategorys" />
      <datalist id="subcategorys">
        <option></option>
        <?php foreach($subcategorys as $subcategory) { ?>
        <option><?= h($subcategory->subcategory_name); ?></option>
        <?php } ?>
      </datalist><br>

      <label for="name">Name</label><br>
      <input id="name" type="text" name="name" value="<?= h($recipe->name); ?>" /><br>

      <label for="cook_time">Cook time</label><br>
      <input id="cook_time" type="number" name="cook_time" value="<?= h($recipe->cook_time); ?>" /><br>

      <label for="amount">Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

      <label for="measurement">Measurement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

      <label for="ingredient">Ingredients</label><br>
      <p class="clarifying">Not all boxes below have to be filled in. If the recipe requires more then fifteen ingredients please email the recipe.</p>

      <?php 
        $i = 1;
        while($i <= 15) {
      ?>
        <span><?= $i; ?>.</span>
        <input id="amount" type="number" name="amount<?= $i; ?>" value="" />
        <input id="measurement" type="text" name="measurement<?= $i; ?>" value="" list="measurements" />
        <input id="ingredient" type="text" name="ingredient<?= $i; ?>" value="" list="ingredients" /><br>
      <?php $i++; } ?>
      <datalist id="ingredients">
        <option></option>
        <?php
          $ingredients = ingredient::find_all_ingredient();
          foreach($ingredients as $ingredient) { 
        ?>
          <option><?= h($ingredient->ingredient_name); ?></option>
        <?php } ?>
      </datalist>

      <datalist id="measurements">
        <option></option>
        <?php 
          $measurements = measurement::find_all_measurement();
          foreach($measurements as $measurement) { 
        ?>
          <option><?= h($measurement->measurement); ?></option>
        <?php } ?>
      </datalist><br>

      <label for="instructions">Instructions</label>
      <p class="clarifying">Not all boxes below have to be filled in. If the recipe requires more then five steps please email the recipe.</p>
      <h3>Step 1</h3>
      <textarea id="instructions"  name="instructions1" value="<?= h($recipe->instructions); ?>"></textarea>
      <h3>Step 2</h3>
      <textarea id="instructions" name="instructions2" value="<?= h($recipe->instructions); ?>"></textarea>
      <h3>Step 3</h3>
      <textarea id="instructions" name="instructions3" value="<?= h($recipe->instructions); ?>"></textarea>
      <h3>Step 4</h3>
      <textarea id="instructions" name="instructions4" value="<?= h($recipe->instructions); ?>"></textarea>
      <h3>Step 5</h3>
      <textarea id="instructions" name="instructions5" value="<?= h($recipe->instructions); ?>"></textarea><br>

      <input type="submit" value="Submit Recipe" />
    </form>
  </div>
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
