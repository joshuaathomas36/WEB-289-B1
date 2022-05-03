<?php
  require_once('../../../private/initialize.php');
  $page_title = "Uploaded image editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $uploaded_images = uploadedimage::find_all();
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a class="back-link" href="../index.php">&laquo; Back to Main Menu</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <table class="admin-table" border="1">
      <tr>
        <th>Uploaded Image ID</th>
        <th>Recipe</th>
        <th>Uploaded Image</th>
        <th>View</th>
        <th>Replace</th>
      </tr>

      <?php
        foreach($uploaded_images as $uploaded_image) {
          $recipe = recipe::find_by_recipe_id($uploaded_image->recipe_id);
      ?>
        <tr>
          <td><?= h($uploaded_image->uploaded_image_id); ?></td>
          <td><?= h($recipe->name); ?></td>
          <td><?= h($uploaded_image->uploaded_image); ?></td>
          <td><a class="action" href="<?= url_for('admins/uploaded-image-editor/show.php?id=' . h(u($uploaded_image->uploaded_image_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/uploaded-image-editor/replace.php?id=' . h(u($uploaded_image->uploaded_image_id))); ?>">Replace</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
