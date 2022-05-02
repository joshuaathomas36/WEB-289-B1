<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($uploaded_image)) {
    redirect_to(url_for('/admins/uploaded-images-editor/index.php'));
  }
  $session->verify_user_level();
?>

    <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt=""><br>
    <label for="image">New Image</label><br>
    <input id="image" type="file" name="new_image"><br>
