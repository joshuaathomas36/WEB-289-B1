<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $ingredient_name = strip_tags($_POST['ingredient_name']);
    $ingredient = new ingredient;
    $result = $ingredient->new_ingredient($ingredient_name);

    if($result === true) {
      $ingredient = ingredient::find_by_ingredient_name($ingredient_name);
      $new_id = $ingredient->ingredient_id;
      $_SESSION['message'] = 'The ingredient was created successfully.';
      redirect_to(url_for('admins/ingredient-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $ingredient = new ingredient;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Ingredient'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Ingredient</h1>

    <?=display_errors($ingredient->errors); ?>

    <form action="<?=url_for('admins/ingredient-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create ingredient" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
