<?php
require_once('../../private/initialize.php');
$page_title = "Foody's Delight: Member Menu"; 
include(SHARED_PATH . '/admin-header.php'); 
// require_login();
$members = member::find_all();
$session->verify_user_level();
?>

<h2>Main Menu</h2>
<a href="index.php">Members</a><br>
<a href="../members/index.php">Members Area</a><br>

<?php include(SHARED_PATH . '/footer.php'); ?>