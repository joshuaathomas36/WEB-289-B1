<?php
require_once('../../private/initialize.php');
$page_title = "Foody's Delight: Admin Menu"; 
include(SHARED_PATH . '/admin-header.php'); 
// require_login();
$session->verify_user_level();
?>

<h2>Main Menu</h2>
<a href="members-editor/index.php">Members Editor</a><br>
<a href="../members/index.php">Members Area</a><br>

<?php include(SHARED_PATH . '/footer.php'); ?>