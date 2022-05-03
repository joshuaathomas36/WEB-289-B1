<?php 
  require_once('../../private/initialize.php');
  $page_title = "Foody's Delight: Super Admin Menu";
  include(SHARED_PATH . '/super-admin-header.php'); 
  $session->verify_super_admin_level();

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

    <p><a class="button" href="../members/account.php">Members Area</a><a class="button" href="../admins/index.php">Admins Area</a></p><br>
    
    <nav class="flexbox">
      <a href="admins-editor/index.php">Admins Editor</a><br>
    </nav>
  </div>
</div>
<?php  include(SHARED_PATH . '/footer.php'); ?>
