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
  if(is_blank($name)) {
    $errors[] = "Name cannot be blank.";
  }
  if(is_blank($name)) {
    $errors[] = "Name cannot be blank.";
  }
  // Submit
  if(empty($errors)) {
    // Classes
    $subcategorys = new subcategory::find_by_subcategory_name($subcategory);
    if(empty($subcategorys)) {
      $subcategorys = new subcategory;
      $subcategorys->subcategory_add($subcategory);
      $subcategorys = new subcategory::find_by_subcategory_name($subcategory);
    }

    


    // $uploadedimage = new uploadedimage;
    // $recipe = new recipe($args);
    // $result = $recipe->new_recipe();
    // $new_id = $recipe->id;
    // $_SESSION['message'] = 'The recipe was created successfully.';
    // $msg = '';

    // Images
    if ($img_size > 125000) {
      $msg = "Sorry, your file is too large.";
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = ['jpg', 'jpeg', 'png'];
      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_image_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $image_upload_path = 'uploaded-images/' . $new_image_name;
        move_uploaded_file($tmp_name, $image_upload_path);

        // Insert into database
        $uploadedimage->upload_image($recipe_id, $new_image_name)
        $msg = 'Recipe has been successfully submitted!';

      } else {
        $em = "This program does not support the $img_ex_lc file type";
        header("Location: index.php?error=$em");
      }
    }
  }
} else {}
?>