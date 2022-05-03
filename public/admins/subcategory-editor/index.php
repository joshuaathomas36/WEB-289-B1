<?php
  require_once('../../../private/initialize.php');
  $page_title = "Subcategory editor";
  include(SHARED_PATH . '/admin-header.php'); 
  $subcategories = subcategory::find_all_subcategory_names();
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

    <a class="action" href="<?= url_for('/admins/subcategory-editor/new.php'); ?>">Create New subcategory</a>
    <table class="admin-table" border="1">
      <tr>
        <th>Subcategory ID</th>
        <th>Subcategory Name</th>
        <th>Category</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

      <?php
        foreach($subcategories as $subcategory) {
          $category = category::find_category_by_id($subcategory->category_id) ?? 'None';
      ?>
        <tr>
          <td><?= h($subcategory->subcategory_id); ?></td>
          <td><?= h($subcategory->subcategory_name); ?></td>
          <td><?= h($category->category_name); ?></td>
          <td><a class="action" href="<?= url_for('admins/subcategory-editor/show.php?id=' . h(u($subcategory->subcategory_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/subcategory-editor/edit.php?id=' . h(u($subcategory->subcategory_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/subcategory-editor/delete.php?id=' . h(u($subcategory->subcategory_id))); ?>">Delete</a></td>
      <?php } ?>
      </tr>
    </table>
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
