<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $uploaded_image = uploadedimage::find_uploaded_image_by_id($id);
  if($uploaded_image == false){
    redirect_to('index.php');
  }
  $recipe = recipe::find_by_recipe_id($uploaded_image->recipe_id);

  $page_title = 'Show Uploaded Image: ' . h($uploaded_image->uploaded_image);
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <h2>Uploaded Image ID: <?= h($uploaded_image->uploaded_image_id); ?></h2>
    <h2>Recipe: <?= h($recipe->name); ?></h2>
    <h2>Uploaded Image: <?= h($uploaded_image->uploaded_image); ?></h2>
    <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
