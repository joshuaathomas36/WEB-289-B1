<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight Recipes <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
    <link rel="icon" type="image/x-icon" href="<?= url_for('uploaded-images/favicon.png') ?>">
    <script src="<?= url_for('js/submit.js') ?>"></script>
  </head>

  <body>

    <header>
      <?php if($session->is_logged_in()) { ?>
          <p id="login"><a class="button" href="<?= url_for('login/logout.php'); ?>">Logout of <?= $session->username; ?></a></p>
      <?php } else { redirect_to(url_for('login/login.php')); } ?>
      <h1>
        <a href="<?= url_for('admins/index.php'); ?>">Foody's Delight <img class="logo" src="<?= url_for('uploaded-images/fdr-logo.JPG') ?>" alt=""> Recipes</a>
      </h1>
      <h2>Admin's Area</h2>
    </header>
