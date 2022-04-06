<?php

if(is_post_request()) {
  // Data
  $img_name = $_FILES['my_image']['name'] ?? '';
  $img_size = $_FILES['my_image']['size'] ?? '';
  $tmp_name = $_FILES['my_image']['tmp_name'] ?? '';
  $error = $_FILES['my_image']['error'] ?? '';

  $subcategory = $_POST['subcategory'] ?? '';
  $name = $_POST['name'] ?? '';
  $cook_time = $_POST['cook_time'] ?? '';

  // Amount
  $amount1 = $_POST['amount1'] ?? '';
  $amount2 = $_POST['amount2'] ?? '';
  $amount3 = $_POST['amount3'] ?? '';
  $amount4 = $_POST['amount4'] ?? '';
  $amount5 = $_POST['amount5'] ?? '';
  $amount6 = $_POST['amount6'] ?? '';
  $amount7 = $_POST['amount7'] ?? '';
  $amount8 = $_POST['amount8'] ?? '';
  $amount9 = $_POST['amount9'] ?? '';
  $amount10 = $_POST['amount10'] ?? '';
  $amount11 = $_POST['amount11'] ?? '';
  $amount12 = $_POST['amount12'] ?? '';
  $amount13 = $_POST['amount13'] ?? '';
  $amount14 = $_POST['amount14'] ?? '';
  $amount15 = $_POST['amount15'] ?? '';

  // measurement
  $measurement1 = $_POST['measurement1'] ?? '';
  $measurement2 = $_POST['measurement2'] ?? '';
  $measurement3 = $_POST['measurement3'] ?? '';
  $measurement4 = $_POST['measurement4'] ?? '';
  $measurement5 = $_POST['measurement5'] ?? '';
  $measurement6 = $_POST['measurement6'] ?? '';
  $measurement7 = $_POST['measurement7'] ?? '';
  $measurement8 = $_POST['measurement8'] ?? '';
  $measurement9 = $_POST['measurement9'] ?? '';
  $measurement10 = $_POST['measurement10'] ?? '';
  $measurement11 = $_POST['measurement11'] ?? '';
  $measurement12 = $_POST['measurement12'] ?? '';
  $measurement13 = $_POST['measurement13'] ?? '';
  $measurement14 = $_POST['measurement14'] ?? '';
  $measurement15 = $_POST['measurement15'] ?? '';

  // Ingredients
  $ingredient1 = $_POST['ingredient1'] ?? '';
  $ingredient2 = $_POST['ingredient2'] ?? '';
  $ingredient3 = $_POST['ingredient3'] ?? '';
  $ingredient4 = $_POST['ingredient4'] ?? '';
  $ingredient5 = $_POST['ingredient5'] ?? '';
  $ingredient6 = $_POST['ingredient6'] ?? '';
  $ingredient7 = $_POST['ingredient7'] ?? '';
  $ingredient8 = $_POST['ingredient8'] ?? '';
  $ingredient9 = $_POST['ingredient9'] ?? '';
  $ingredient10 = $_POST['ingredient10'] ?? '';
  $ingredient11 = $_POST['ingredient11'] ?? '';
  $ingredient12 = $_POST['ingredient12'] ?? '';
  $ingredient13 = $_POST['ingredient13'] ?? '';
  $ingredient14 = $_POST['ingredient14'] ?? '';
  $ingredient15 = $_POST['ingredient15'] ?? '';
  
  // Instructions
  $instructions1 = $_POST['instructions1'] ?? '';
  $instructions2 = $_POST['instructions2'] ?? '';
  $instructions3 = $_POST['instructions3'] ?? '';
  $instructions4 = $_POST['instructions4'] ?? '';
  $instructions5 = $_POST['instructions5'] ?? '';

  // combine them. ^^^^^^^
  $instructions = '{}' ?? ''

  // Validations
  if(is_blank($img_name)) {
    $errors[] = "Image cannot be blank.";
  }
  if(is_blank($subcategory)) {
    $errors[] = "subcategory cannot be blank.";
  }
  if(is_blank($name)) {
    $errors[] = "Name cannot be blank.";
  }
  if(is_blank($cook_time)) {
    $errors[] = "Cook time cannot be blank.";
  }
  if(is_blank($instructions1)) {
    $errors[] = "There must be a first step in the recipe";
  }
  // Submit
  if(empty($errors)) {
    // Classes
    

    


    // 
    // $recipe = new recipe($args);
    // $result = $recipe->new_recipe();
    // $new_id = $recipe->id;
    // $_SESSION['message'] = 'The recipe was created successfully.';

    // Images
    if ($img_size > 125000) {
      $msg = "Sorry, your file is too large.";
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = ['jpg', 'jpeg', 'png'];
      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_image_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $image_upload_path = '../uploaded-images/' . $new_image_name;
        move_uploaded_file($tmp_name, $image_upload_path);

        // Insert into database
        $subcategorys = new subcategory::find_by_subcategory_name($subcategory);
        if(empty($subcategorys)) {
          $subcategorys = new subcategory;
          $subcategorys->subcategory_add($subcategory);
          $subcategorys = new subcategory::find_by_subcategory_name($subcategory);
        }

        



        $uploadedimage = new uploadedimage;
        $uploadedimage->upload_image($recipe_id, $new_image_name);
        $msg = 'Recipe has been successfully submitted!';

      } else {
        $msg = "Unable to submit recipe do to the following: This program does not support the $img_ex_lc file type. The supported file types are 'jpg', 'jpeg', and 'png'.";
      }
    }
  }
} else {}
?>