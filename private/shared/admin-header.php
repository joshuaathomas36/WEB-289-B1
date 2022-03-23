<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight Recipes <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
    <link rel="icon" type="image/x-icon" href="<?= url_for('uploaded-images/favicon.png') ?>">
  </head>

  <body>

    <header>
      <h1>
        <a href="<?= url_for('admins/index.php'); ?>">Foody's Delight <img class="logo" src="<?= url_for('uploaded-images/fdr-logo.JPG') ?>" alt=""> Recipes</a>
      </h1>
      <h2>Admin's Area</h2>
    </header>

    <navigation>
      <ul>
       <?php
        if($session->is_logged_in()) { ?>
            <li>User: <?= $session->username; ?></li>
            <li><a href="<?= url_for('login/logout.php'); ?>">Logout</li>

        <?php } else { redirect_to(url_for('login/login.php')); } ?>
      </ul>
    </navigation>
  
