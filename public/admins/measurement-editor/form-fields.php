<?php
  // prevents this code from being loaded directly in the browser
  // or without first setting the necessary object
  if(!isset($measurement)) {
    redirect_to(url_for('/admins/measurement-editor/index.php'));
  }
  $session->verify_user_level();
?>

<label for="measurement">Measurement</label><br>
<input id="measurement" type="text" name="measurement" value="<?= h($measurement->measurement); ?>" /><br>
