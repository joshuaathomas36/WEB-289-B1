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

    <nav>
      <a href="../members/account.php">Members Area</a>
      <a href="members-editor/index.php">Members Editor</a>
      <a href="recipe-editor/index.php">Recipe Editor</a>
    </nav>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
