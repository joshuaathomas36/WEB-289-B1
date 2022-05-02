<?php
  require_once('../../private/initialize.php');
  $page_title = "Foody's Delight: Admin Menu"; 
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">

    <h2>Main Menu</h2>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <p><a class="button" href="../members/account.php">Members Area</a><br></p>
    <nav class="flexbox">
      <a href="members-editor/index.php">Members Editor</a>
      <a href="recipe-editor/index.php">Recipes Editor</a>
      <a href="recipe-ingredient-editor/index.php">Recipe ingredients Editor</a>

      <a href="measurement-editor/index.php">Measurement Editor</a>
      <a href="ingredient-editor/index.php">Ingredient Editor</a>
      <a href="uploaded-image-editor/index.php">Uploaded images Editor</a>

      <a href="subcategory-editor/index.php">Subcategory Editor</a>
      <a href="category-editor/index.php">Category Editor</a>
      <a href="review-editor/index.php">Review Editor</a>
    </nav>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
