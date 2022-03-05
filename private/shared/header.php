<!doctype html>
<html lang="en">

  <head>
    <title>Foody's Delight <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?= url_for('/css/styles.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?= url_for('/index.php'); ?>">Foody's Delight</a>
      </h1>
    </header>

    <navigation>
      <ul>
        <li><a href="<?= url_for('/index.php'); ?>">Home</a></li>
        <?php 
          $categorys = category::find_all(); 
          foreach($categorys as $category) {
            $link = strtolower($category->category_name)
        ?>
          <li><a href="<?= url_for('/' . $link . '.php'); ?>"><?= $category->category_name ?></a></li>
        <?php } ?>
      </ul>
    </navigation>
  