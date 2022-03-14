<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight Recipes <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
  </head>

  <body>

    <header>
      <?php
        if($session->is_logged_in()) { ?>
          <p id="login"><a class="button" href="<?= url_for('login/logout.php'); ?>">Logout of <?= $session->username; ?></a> <a class="button" href="<?= url_for('members/account.php'); ?>">Account</a> <a class="button" href="<?= url_for('members/submitrecipe.php'); ?>">Submit Recipe</a> <a class="button" href="<?= url_for('members/recommendrecipe.php'); ?>">Recommend Recipe</a></p>
      <?php } else { redirect_to(url_for('login/login.php')); } ?>
      <h1>
        <a href="<?= url_for('../public/members/index.php'); ?>">Foody's Delight Recipes</a>
      </h1>
    </header>

    <nav>
      <a class="<?php if($page == 'Home') {echo 'active';} ?>" href="<?= url_for('/members/index.php'); ?>">Home</a>
      <?php 
        $categorys = category::find_all(); 
        foreach($categorys as $category) {
          $link = strtolower($category->category_name)
        ?>
        <a class="<?php if($page == $category->category_name) {echo 'active';} ?>" href="<?= url_for('/members/' . $link . '.php'); ?>"><?= $category->category_name ?></a>
      <?php } ?>
    </nav>
  
