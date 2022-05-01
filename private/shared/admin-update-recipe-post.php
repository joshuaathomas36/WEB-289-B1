<?php
  // Data
  $subcategory = strip_tags($_POST['subcategory']) ?? '';
  $name = strip_tags($_POST['name']) ?? '';
  $cook_time = $_POST['cook_time'] ?? '';
  
  // Instructions
  $instructions1 = strip_tags($_POST['instructions1']) ?? '';
  $instructions2 = strip_tags($_POST['instructions2']) ?? '';
  $instructions3 = strip_tags($_POST['instructions3']) ?? '';
  $instructions4 = strip_tags($_POST['instructions4']) ?? '';
  $instructions5 = strip_tags($_POST['instructions5']) ?? '';
  
  $instructions = '{"Step 1" : "' . $instructions1 . '", "Step 2" : "' . $instructions2 . '", "Step 3" : "' . $instructions3 . '", "Step 4" : "' . $instructions4 . '", "Step 5" : "' . $instructions5 . '"}' ?? '';

  // Validations
  if(is_blank($img_name)) {
    $errors[] = "Image cannot be blank.";
  }
  if(is_blank($subcategory)) {
    $errors[] = "subcategory cannot be blank.";
  }
  if(is_blank($name)) {
    $errors[] = "The Name cannot be blank.";
  }
  if(strlen($name) > 50) {
    $errors[] = "The Name cannot be more then fifty characters.";
  }
  if(is_blank($cook_time)) {
    $errors[] = "Cook time cannot be blank.";
  }
  if(is_blank($instructions1)) {
    $errors[] = "There must be a first step in the recipe";
  }
  // $duplicate_check = recipe::find_by_name($name) ?? '';
  // if($duplicate_check != false) {
  //   $errors[] = "There is already a recipe with that name, please choose another one.";
  // }
  // Submit
  if(empty($errors)) {
    // Insert into database
    $subcategorys = subcategory::find_by_subcategory_name($subcategory);
    if(empty($subcategorys)) {
      $subcategorys = new subcategory;
      $subcategorys->subcategory_add($subcategory);
      $subcategorys = subcategory::find_by_subcategory_name($subcategory);
    }

    $recipe = new recipe;
    $recipe->update_recipe($recipe_id, $name, $cook_time, $instructions, $subcategory_id);

    $result = recipe::find_by_name($name);
    $new_id = $result->recipe_id;
    $result = true;
  }
?>
