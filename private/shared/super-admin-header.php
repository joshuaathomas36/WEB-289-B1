<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight Recipes <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?= url_for('../public/index.php'); ?>">Foody's Delight Recipes</a>
      </h1>
      <h2>Super Admin's Area</h2>
    </header>

    <navigation>
      <ul>
        <?php if($session->is_logged_in()) { 
          if($session->user_level == 'S') {
        ?>
          <li>User: <?= $session->username; ?></li>
          <li><a href="<?= url_for('login/logout.php'); ?>">Logout</li>
        <?php } else { redirect_to(url_for('login/login.php')); }
        } else { redirect_to(url_for('login/login.php')); } ?>
      </ul>
    </navigation>
  
    <?php echo display_session_message(); ?>
