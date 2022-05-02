<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $category = category::find_category_by_id($id);
  if($category == false){
    redirect_to('index.php');
  }

  $page_title = 'Show Category: ' . h($category->category_name);
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

    <h2>Category ID: <?= h($category->category_id); ?></h2>
    <h2>Category Name: <?= h($category->category_name); ?></h2>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
