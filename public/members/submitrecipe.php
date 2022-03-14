<?php

require_once('../../private/initialize.php');

$msg = '';

if(is_post_request()) {

  $args = $_POST['recipe'];
  $recipe = new recipe($args);
  $result = $recipe->new_recipe();

  if($result === true) {
    $new_id = $recipe->id;
    $_SESSION['message'] = 'The recipe was created successfully.';
    $msg = '';
  } else {
    
  }

} else {
  
}

?>

<?php $page_title = 'Submit a Recipe'; ?>
<?php include(SHARED_PATH . '/member-header.php'); ?>

<div id="wrapper">
  <div id="form">
    <h2>Submit a Recipe</h2>

    <?php $recipe = new recipe; ?>
    <?=display_errors($recipe->errors); ?>
    <?= $msg; ?>

    <form method="post">
      <dl>
      <dt>Name</dt>
        <dd><input type="text" name="recipe[name]" value="<?= h($recipe->name); ?>" /></dd>
      </dl>

      <dl>
        <dt>Cook time</dt>
        <dd><input type="text" name="recipe[cook_time]" value="<?= h($recipe->cook_time); ?>" /></dd>
      </dl>

      <dl>
        <dt>Instructions</dt>
        <dd><input type="text" name="recipe[instructions]" value="<?= h($recipe->instructions); ?>" /></dd>
      </dl>

      <dl>
        <dt>Subcategory</dt>
        <dd><input type="text" name="recipe[subcategory_id]" value="<?= h($recipe->subcategory_id); ?>" /></dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Submit Recipe" />
      </div>
    </form>
  </div>
</div>


<?php include(SHARED_PATH . '/footer.php'); ?>
