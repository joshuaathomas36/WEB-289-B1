<?php
  require_once('../../private/initialize.php');

  $id = $_GET['id'] ?? '';
  if(!is_blank($id)) {
    $recipe = recipe::find_by_recipe_id($id);
  }
 

  $errors = [];
  $msg = '';
  $email = '';
  $recipe_name = '';
  $recipe_name = $recipe->name ?? '';

  if(is_post_request()) {

    $email = $_POST['email'] ?? '';
    $recipe_name = $_POST['recipe_name'] ?? '';

    // Validations
    if(is_blank($email)) {
      $errors[] = "Username cannot be blank.";
    }
    if(is_blank($recipe_name)) {
      $errors[] = "You must chose a recipe.";
    }

    // if there were no errors, try to login
    if(empty($errors)) {
      $member = member::find_by_email($email);
      $recipe = recipe::find_by_name($recipe_name);
      if($member != false && $recipe != false) {
        $recommended = new recommended;
        $recommended->recommended_add($session->user_id, $member->user_id, $recipe->recipe_id);
        $msg = "Recipe has been recommended";
      } else {
        $errors[] = "Please make sure both are correct.";
      }
    }
  }
?>

<?php $page_title = 'recommend recipe'; ?>
<?php include(SHARED_PATH . '/member-header.php'); ?>

<div id="wrapper">
  <div id="form">
    <h2>Recommend a Recipe to a Friend!</h2>
    <p>Enter your friends Email and the recipe you wish to recommend below.</p>
    <p>Attention: the email you enter must be the email of a current member.</p>

    <?= display_errors($errors); ?>
    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    

    <form method="post">
      <label for="email">Email:</label><br>
      <input id="email" type="text" name="email" value="<?= h($email); ?>" /><br>

      <label for="recipe">Recipe:</label><br>
      <input id="recipe" type="text" name="recipe_name" value="<?= h($recipe_name); ?>" list="recipe_name" />
      <datalist id="recipe_name">
        <option></option>
        <?php 
          $recipes = recipe::find_all();
          foreach($recipes as $recipe) { 
        ?>
        <option><?= $recipe->name ?></option>
        <?php } ?>
      </datalist><br>

      <input type="submit" name="submit" value="Submit"  />
    </form>

  </div>
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
