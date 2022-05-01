<?php

if(is_post_request()) {
  // Data
  $img_name = $_FILES['my_image']['name'] ?? '';
  $img_size = $_FILES['my_image']['size'] ?? '';
  $tmp_name = $_FILES['my_image']['tmp_name'] ?? '';
  $error = $_FILES['my_image']['error'] ?? '';

  $subcategory = strip_tags($_POST['subcategory']) ?? '';
  $name = strip_tags($_POST['name']) ?? '';
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
  $ingredient1 = strip_tags($_POST['ingredient1']) ?? '';
  $ingredient2 = strip_tags($_POST['ingredient2']) ?? '';
  $ingredient3 = strip_tags($_POST['ingredient3']) ?? '';
  $ingredient4 = strip_tags($_POST['ingredient4']) ?? '';
  $ingredient5 = strip_tags($_POST['ingredient5']) ?? '';
  $ingredient6 = strip_tags($_POST['ingredient6']) ?? '';
  $ingredient7 = strip_tags($_POST['ingredient7']) ?? '';
  $ingredient8 = strip_tags($_POST['ingredient8']) ?? '';
  $ingredient9 = strip_tags($_POST['ingredient9']) ?? '';
  $ingredient10 = strip_tags($_POST['ingredient10']) ?? '';
  $ingredient11 = strip_tags($_POST['ingredient11']) ?? '';
  $ingredient12 = strip_tags($_POST['ingredient12']) ?? '';
  $ingredient13 = strip_tags($_POST['ingredient13']) ?? '';
  $ingredient14 = strip_tags($_POST['ingredient14']) ?? '';
  $ingredient15 = strip_tags($_POST['ingredient15']) ?? '';
  
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
  $duplicate_check = recipe::find_by_name($name) ?? '';
  if($duplicate_check != false) {
    $errors[] = "There is already a recipe with that name, please choose another one.";
  }
  if(is_blank($cook_time)) {
    $errors[] = "Cook time cannot be blank.";
  }
  if(is_blank($instructions1)) {
    $errors[] = "There must be a first step in the recipe";
  }
  // Submit
  if(empty($errors)) {
    // Images
    if ($img_size > 125000) {
      $msg = "Sorry, your Image is too large of a file.";
    } else {
      $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = ['jpg', 'jpeg', 'png'];

      if (in_array($img_ex_lc, $allowed_exs)) {
        $new_image_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
        $image_upload_path = '../uploaded-images/' . $new_image_name;
        move_uploaded_file($tmp_name, $image_upload_path);

        // Insert into database
        $subcategorys = subcategory::find_by_subcategory_name($subcategory);
        if(empty($subcategorys)) {
          $subcategorys = new subcategory;
          $subcategorys->subcategory_add($subcategory);
          $subcategorys = subcategory::find_by_subcategory_name($subcategory);
        }

        if(!empty($ingredient1)) {
          $ingredients1 = ingredient::find_by_ingredient_name($ingredient1);
          if(empty($ingredients1)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient1);
            $ingredients1 = ingredient::find_by_subcategory_name($ingredient1);
          }
        }
        
        if(!empty($ingredient2)) {
          $ingredients2 = ingredient::find_by_ingredient_name($ingredient2);
          if(empty($ingredients2)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient2);
            $ingredients2 = ingredient::find_by_subcategory_name($ingredient2);
          }
        }

        if(!empty($ingredient3)) {
          $ingredients3 = ingredient::find_by_ingredient_name($ingredient3);
          if(empty($ingredients3)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient3);
            $ingredients3 = ingredient::find_by_subcategory_name($ingredient3);
          }
        }

        if(!empty($ingredient4)) {
          $ingredients4 = ingredient::find_by_ingredient_name($ingredient4);
          if(empty($ingredients4)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient4);
            $ingredients4 = ingredient::find_by_subcategory_name($ingredient4);
          }
        }

        if(!empty($ingredient5)) {
          $ingredients5 = ingredient::find_by_ingredient_name($ingredient5);
          if(empty($ingredients5)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient5);
            $ingredients5 = ingredient::find_by_subcategory_name($ingredient5);
          }
        }

        if(!empty($ingredient6)) {
          $ingredients6 = ingredient::find_by_ingredient_name($ingredient6);
          if(empty($ingredients6)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient6);
            $ingredients6 = ingredient::find_by_subcategory_name($ingredient6);
          }
        }

        if(!empty($ingredient7)) {
          $ingredients7 = ingredient::find_by_ingredient_name($ingredient7);
          if(empty($ingredients7)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient7);
            $ingredients7 = ingredient::find_by_subcategory_name($ingredient7);
          }
        }

        if(!empty($ingredient8)) {
          $ingredients8 = ingredient::find_by_ingredient_name($ingredient8);
          if(empty($ingredients8)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient8);
            $ingredients8 = ingredient::find_by_subcategory_name($ingredient8);
          }
        }

        if(!empty($ingredient9)) {
          $ingredients9 = ingredient::find_by_ingredient_name($ingredient9);
          if(empty($ingredients9)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient9);
            $ingredients9 = ingredient::find_by_subcategory_name($ingredient9);
          }
        }

        if(!empty($ingredient10)) {
          $ingredients10 = ingredient::find_by_ingredient_name($ingredient10);
          if(empty($ingredients10)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient10);
            $ingredients10 = ingredient::find_by_subcategory_name($ingredient10);
          }
        }

        if(!empty($ingredient11)) {
          $ingredients11 = ingredient::find_by_ingredient_name($ingredient11);
          if(empty($ingredients11)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient11);
            $ingredients11 = ingredient::find_by_subcategory_name($ingredient11);
          }
        }

        if(!empty($ingredient12)) {
          $ingredients12 = ingredient::find_by_ingredient_name($ingredient12);
          if(empty($ingredients12)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient12);
            $ingredients12 = ingredient::find_by_subcategory_name($ingredient12);
          }
        }

        if(!empty($ingredient13)) {
          $ingredients13 = ingredient::find_by_ingredient_name($ingredient13);
          if(empty($ingredients13)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient13);
            $ingredients13 = ingredient::find_by_subcategory_name($ingredient13);
          }
        }

        if(!empty($ingredient14)) {
          $ingredients14 = ingredient::find_by_ingredient_name($ingredient14);
          if(empty($ingredients14)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient14);
            $ingredients14 = ingredient::find_by_subcategory_name($ingredient14);
          }
        }

        if(!empty($ingredient15)) {
          $ingredients15 = ingredient::find_by_ingredient_name($ingredient15);
          if(empty($ingredients15)) {
            $ingredient = new ingredient;
            $ingredient->new_ingredient($ingredient15);
            $ingredients15 = ingredient::find_by_subcategory_name($ingredient15);
          }
        }

        $recipe = new recipe;
        $recipe->new_recipe($name, $cook_time, $instructions, $subcategorys->subcategory_id, 0);
        $result = recipe::find_by_name($name);
        $new_id = $result->recipe_id;

        if(!is_blank($amount1) && !is_blank($measurement1) && !is_blank($ingredients1->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount1, $measurement1, $ingredients1->ingredient_id);
        }

        if(!is_blank($amount2) && !is_blank($measurement2) && !is_blank($ingredients2->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount2, $measurement2, $ingredients2->ingredient_id);
        }

        if(!is_blank($amount3) && !is_blank($measurement3) && !is_blank($ingredients3->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount3, $measurement3, $ingredients3->ingredient_id);
        }

        if(!is_blank($amount4) && !is_blank($measurement4) && !is_blank($ingredients4->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount4, $measurement4, $ingredients4->ingredient_id);
        }

        if(!is_blank($amount5) && !is_blank($measurement5) && !is_blank($ingredients5->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount5, $measurement5, $ingredients5->ingredient_id);
        }

        if(!is_blank($amount6) && !is_blank($measurement6) && !is_blank($ingredients6->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount6, $measurement6, $ingredients6->ingredient_id);
        }

        if(!is_blank($amount7) && !is_blank($measurement7) && !is_blank($ingredients7->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount7, $measurement7, $ingredients7->ingredient_id);
        }

        if(!is_blank($amount8) && !is_blank($measurement8) && !is_blank($ingredients8->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount8, $measurement8, $ingredients8->ingredient_id);
        }

        if(!is_blank($amount9) && !is_blank($measurement9) && !is_blank($ingredients9->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount9, $measurement9, $ingredients9->ingredient_id);
        }

        if(!is_blank($amount10) && !is_blank($measurement10) && !is_blank($ingredients10->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount10, $measurement10, $ingredients10->ingredient_id);
        }

        if(!is_blank($amount11) && !is_blank($measurement11) && !is_blank($ingredients11->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount11, $measurement11, $ingredients11->ingredient_id);
        }

        if(!is_blank($amount12) && !is_blank($measurement12) && !is_blank($ingredients12->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount12, $measurement12, $ingredients12->ingredient_id);
        }

        if(!is_blank($amount13) && !is_blank($measurement13) && !is_blank($ingredients13->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount13, $measurement13, $ingredients13->ingredient_id);
        }

        if(!is_blank($amount14) && !is_blank($measurement14) && !is_blank($ingredients14->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount14, $measurement14, $ingredients14->ingredient_id);
        }

        if(!is_blank($amount15) && !is_blank($measurement15) && !is_blank($ingredients15->ingredient_id)) {
          $recipe_ingredient = new recipe_ingredient;
          $recipe_ingredient->new_recipe_ingredient($new_id, $amount15, $measurement15, $ingredients15->ingredient_id);
        }

        $uploadedimage = new uploadedimage;
        $uploadedimage->upload_image($new_id, $new_image_name);
        $msg = 'Recipe has been successfully submitted!';
        $result = true;

      } else {
        $msg = "Unable to submit recipe do to the following: This program does not support the $img_ex_lc file type. The supported file types are 'jpg', 'jpeg', and 'png'.";
      }
    }
  }
} else {}
?>
