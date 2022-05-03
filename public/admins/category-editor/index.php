<?php
  require_once('../../../private/initialize.php');
  $page_title = "category editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $categories = category::find_all();
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a class="back-link" href="../index.php">&laquo; Back to Main Menu</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <a class="action" href="<?= url_for('/admins/category-editor/new.php'); ?>">Create New category</a>
    <table class="admin-table" border="1">
      <tr>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php foreach($categories as $category) { ?>
        <tr>
          <td><?= h($category->category_id); ?></td>
          <td><?= h($category->category_name); ?></td>
          <td><a class="action" href="<?= url_for('admins/category-editor/show.php?id=' . h(u($category->category_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/category-editor/edit.php?id=' . h(u($category->category_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/category-editor/delete.php?id=' . h(u($category->category_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
