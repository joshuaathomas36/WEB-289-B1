<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
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
          <a href="<?= url_for('/index.php'); ?>">Foody's Delight</a>
        </h1>
    </header>

    <nav>
      <a href="<?= url_for('/index.php'); ?>">Home</a>
      <?php 
        $categorys = category::find_all(); 
        foreach($categorys as $category) {
          $link = strtolower($category->category_name)
        ?>
        <a href="<?= url_for('/' . $link . '.php'); ?>"><?= $category->category_name ?></a>
      <?php } ?>
    </nav>
  