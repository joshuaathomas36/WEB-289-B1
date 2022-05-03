<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($recipe)) {
    redirect_to(url_for('/admins/recipe-editor/index.php'));
  }
  $session->verify_user_level();
  $subcategorys = subcategory::find_all_subcategory_names();
  if($recipe->subcategory_id != 0) {
    $sub_name = subcategory::find_by_subcategory_id($recipe->subcategory_id) ?? '';
  } else {
    $sub_name = '';
  }
?>

  <?php
    $uploaded_image = uploadedimage::find_by_recipe_id($recipe->recipe_id);
    if($uploaded_image != false) {
  ?>
    <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt=""><br>
  <?php } else { ?> 
    <label for="image">Image</label><br>
    <input id="image" type="file" name="my_image"><br>
  <?php } ?> 

  <label for="subcategory">Subcategory</label><br>
  <?php if(!empty($sub_name)) { ?>
    <input id="subcategory" type="text" name="subcategory" value="<?= h($sub_name->subcategory_name); ?>" list="subcategorys" />
  <?php 
    } else {
  ?>
    <input id="subcategory" type="text" name="subcategory" value="" list="subcategorys" />
  <?php } ?>

  <datalist id="subcategorys">
    <?php foreach($subcategorys as $subcategory) { ?>
      <option><?= h($subcategory->subcategory_name); ?></option>
    <?php } ?>
  </datalist><br>

  <label for="name">Name</label><br>
  <input id="name" type="text" name="name" value="<?= h($recipe->name); ?>" /><br>

  <label for="cook_time">Cook time</label><br>
  <input id="cook_time" type="number" name="cook_time" value="<?= h($recipe->cook_time); ?>" /><br>

  <?php if(empty($id)){ ?>
  <label for="amount">Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

  <label for="measurement">Measurement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

  <label for="ingredient">Ingredients</label><br>

    <?php
      $i = 1;
      while($i <= 15) {
    ?>
      <span><?= $i; ?>.</span>
      <input id="amount" type="number" name="amount<?= $i; ?>" value="" />

      <select id="measurement" name="measurement<?= $i; ?>">
        <option value=""></option>
          <?php 
            $measurements = measurement::find_all_measurement();
            foreach($measurements as $measurement) { 
          ?>
            <option value="<?= h($measurement->measurement_id); ?>"><?= h($measurement->measurement); ?></option>
          <?php } ?>
      </select>

      <input id="ingredient" type="text" name="ingredient<?= $i; ?>" value="" list="ingredients" /><br>
    <?php $i++; }} ?>
  <datalist id="ingredients">
    <option></option>
    <?php
      $ingredients = ingredient::find_all_ingredient();
      foreach($ingredients as $ingredient) { 
    ?>
      <option><?= h($ingredient->ingredient_name); ?></option>
    <?php } ?>
  </datalist><br>

  <label for="instructions">Instructions</label>
  <?php 
    $steps = $recipe->admin_instructions($recipe->instructions);
    $step1 = $steps["Step 1"] ?? '';
    $step2 = $steps["Step 2"] ?? '';
    $step3 = $steps["Step 3"] ?? '';
    $step4 = $steps["Step 4"] ?? '';
    $step5 = $steps["Step 5"] ?? '';
  ?>

  <h3>Step 1</h3>
  <textarea id="instructions" name="instructions1" value=""><?= h($step1); ?></textarea>
  <h3>Step 2</h3>
  <textarea id="instructions" name="instructions2" value=""><?= h($step2); ?></textarea>
  <h3>Step 3</h3>
  <textarea id="instructions" name="instructions3" value=""><?= h($step3); ?></textarea>
  <h3>Step 4</h3>
  <textarea id="instructions" name="instructions4" value=""><?= h($step4); ?></textarea>
  <h3>Step 5</h3>
  <textarea id="instructions" name="instructions5" value=""><?= h($step5); ?></textarea><br>
