<?php

  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    
    include(SHARED_PATH . '/member-submitrecipe-post.php');

    if($result === true) {
      $_SESSION['message'] = 'The recipe was created successfully.';
      redirect_to(url_for('admins/recipe-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $recipe = new recipe;
  }

  $session->verify_user_level();
  $page_title = 'Create a Recipe';
  include(SHARED_PATH . '/admin-header.php');
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h2>Create Recipe</h2>

    <?=display_errors($recipe->errors); ?>

    <form action="<?=url_for('admins/recipe-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Recipe" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
