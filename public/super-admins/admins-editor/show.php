<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $member = member::find_by_id($id);
  if($member == false){
    redirect_to('index.php');
  }

  if($member->user_level == "S"){
    redirect_to('index.php');
  }

  $page_title = 'Show All Users: ' . h($member->full_name());
  include(SHARED_PATH . '/super-admin-header.php'); 
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

    <h2>Member: <?= h($member->full_name()); ?></h2>
      
        <h3>User ID:</h3>
        <p><?= h($member->user_id); ?></p>
    
        <h3>First Name:</h3>
        <p><?= h($member->first_name); ?></p>
      
        <h3>Last Name:</h3>
        <p><?= h($member->last_name); ?></p>
      
        <h3>Email:</h3>
        <p><?= h($member->email); ?></p>
      
        <h3>Username:</h3>
        <p><?= h($member->username); ?></p>
      
        <h3>User Level:</h3>
        <p><?= h($member->user_level); ?></p>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
