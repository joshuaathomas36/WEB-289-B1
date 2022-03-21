<?php
require_once('../../private/initialize.php');

$errors = [];
$msg = '';
$username = '';
$recipe_name = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $recipe_name = $_POST['recipe_name'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($recipe_name)) {
    $errors[] = "You must chose a recipe.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $member = member::find_by_username($username);
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
    <p>Enter your friends username and the recipe you wish to recommend below.</p>

    <?= display_errors($errors); ?>
    <?= $msg; ?>

    <?php
      $members = member::find_all();
      $recipes = recipe::find_all();
    ?>

    <form method="post">
      Username:<br>
      <input type="text" name="username" value="<?= h($username); ?>" /><br>

      Recipe:<br>
      <input type="text" name="recipe_name" value="<?= h($recipe_name); ?>" list="recipe_name" />
      <datalist id="recipe_name">
        <option></option>
        <?php foreach($recipes as $recipe) { ?>
        <option><?= $recipe->name ?></option>
        <?php } ?>
      </datalist><br>

      <input type="submit" name="submit" value="Submit"  />
    </form>

  </div>
  <?php  include(SHARED_PATH . '/footer.php'); ?>
</div>
