<?php

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['recipe'];
  $recipe = new recipe($args);
  $result = $recipe->save();

  if($result === true) {
    $new_id = $recipe->id;
    $_SESSION['message'] = 'The recipe was created successfully.';
    redirect_to(url_for('members/index.php'));
  } else {
    // show errors
  }

} else {
  // display the form
  $recipe = new recipe;
}

?>

<?php $page_title = 'Submit a Recipe'; ?>
<?php include(SHARED_PATH . '/member-header.php'); ?>

  <a href="index.php">&laquo; Back to List</a>

    <h2>Submit a Recipe</h2>

    <?=display_errors($recipe->errors); ?>

    <form action="<?=url_for('members/submitrecipe.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Submit Recipe" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
