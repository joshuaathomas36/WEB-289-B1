<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  $page_title = 'Show All Users: ';
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();

  $msg = "";
  $string = "";

  if(is_post_request()) {
    $status = $recipe->approved($recipe->approved);

    if($status == 'No') {
      $new_status = 1;
      $recipe->Change_approved_status($id, $new_status);
      $result = true;
    } elseif($status == 'Yes') {
      $new_status = 0;
      $recipe->Change_approved_status($id, $new_status);
      $result = true;
    } else {
      $msg = 'An error has occurred, please try again later.';
      $result = false;
    }

    if($result === true) {
      $_SESSION['message'] = 'The recipe was updated successfully.';
      redirect_to(url_for('/admins/recipe-editor/index.php'));
    } else {
      // show errors
      display_errors($recipe->errors);
    }

  }
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <h2>Recipe: <?= h($recipe->name); ?></h2>
    <h3>Current approved status:</h3>
    <p><?= h($recipe->approved($recipe->approved)); ?></p>

    <h3>Change approved status?</h3>
    <form action="approve.php" method="post">
      <input type="submit" name="submit" value="Change approved status."  />
    </form>
    
  </div>
</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
