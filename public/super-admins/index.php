<?php 
require_once('../../private/initialize.php');
$page_title = "Foody's Delight: Super Admin Menu";
include(SHARED_PATH . '/super-admin-header.php'); 
$session->verify_super_admin_level();
?>

<h2>Main Menu</h2>
<a href="admins-editor/index.php">Admins Editor</a><br>
<a href="../admins/members-editor/index.php">Members Editor</a><br>
<a href="../members/index.php">Members Area</a><br>

    <?php  include(SHARED_PATH . '/footer.php'); ?>
