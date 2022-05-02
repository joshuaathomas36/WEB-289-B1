<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $subcategory = subcategory::find_by_subcategory_id($id);
  if($subcategory == false){
    redirect_to('index.php');
  }
  $category = category::find_category_by_id($subcategory->category_id);

  $page_title = 'Show Subcategory: ' . h($subcategory->subcategory_name);
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

    <h2>Subcategory ID: <?= h($subcategory->subcategory_id); ?></h2>
    <h2>Subcategory Name: <?= h($subcategory->subcategory_name); ?></h2>
    <h2>Category: <?= h($category->category_name); ?></h2>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
