<?php
  require_once('../../../private/initialize.php');
  $msg = "";
  $admin_upload = 'Y';
  $result = '';
  $errors = [];
  include(SHARED_PATH . '/member-submitrecipe-post.php');

  if($result == true) {
    $_SESSION['message'] = 'The recipe was created successfully.';
    redirect_to(url_for('admins/recipe-editor/show.php?id=' . $new_id));
  } else {
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
    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <h2>Create Recipe</h2>

    <?=display_errors($errors); ?>

    <form action="<?=url_for('admins/recipe-editor/new.php'); ?>" method="post" enctype="multipart/form-data">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create Recipe" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
