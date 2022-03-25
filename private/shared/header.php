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
      <?php
        if($session->is_logged_in()) {
          $member = member::find_by_id($session->user_id);
          $member->check_user_level($session->user_level);
        } else { } ?>

      <p id="login"><a class="button" href="<?= url_for('/login/login.php'); ?>">Log in</a> &nbsp; <a class="button" href="<?= url_for('/login/signup.php'); ?>">Become a Member</a></p>
        <h1>
          <a href="<?= url_for('/index.php'); ?>">Foody's Delight <img class="logo" src="<?= url_for('uploaded-images/fdr-logo.JPG') ?>" alt=""> Recipes</a>
        </h1>
    </header>

    <nav>
      <a class="<?php if($page == 'Home') {echo 'active';} ?>" href="<?= url_for('/index.php'); ?>">Home</a>
      <?php 
        $categorys = category::find_all(); 
        foreach($categorys as $category) {
          $link = strtolower($category->category_name)
        ?>
        <a class="<?php if($page == $category->category_name) {echo 'active';} ?>" href="<?= url_for('/' . $link . '.php'); ?>"><?= $category->category_name ?></a>
      <?php } ?>
    </nav>
  