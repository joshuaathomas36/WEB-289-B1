<?php

if(is_post_request()) {
  $remove = $_POST['Remove'] ?? '';
  $add = $_POST['Add'] ?? '';

  $is_favorite = $_POST['favorite'] ?? '';
  $unfavorite = $_POST['unfavorite'] ?? '';

  $user_id = $session->user_id;
  $recipe_id = $_POST['id'] ?? '';

  $removeRCD = $_POST['removeRCD'] ?? '';

  if(!empty($remove) || !empty($add)) {
    $mealplanner = new mealplanner;
    if(!empty($remove)) {
      $mealplanner->meal_planner_remove($user_id, $recipe_id);
    } elseif(!empty($add)) {
      $mealplanner->meal_planner_add($user_id, $recipe_id);
    }
  } elseif(!empty($is_favorite) || !empty($unfavorite)) {
    $favorite = new favorite;
    if(!empty($unfavorite)) {
      $favorite->favorite_remove($user_id, $recipe_id);
    } elseif(!empty($is_favorite)) {
      $favorite->favorite_add($user_id, $recipe_id);
    }
  } elseif(!empty($removeRCD)) {
    $recommended = new recommended;
    $recommended->recommended_remove($user_id, $recipe_id);
  } else {

  }
}

?>