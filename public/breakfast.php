<?php 
require_once('../private/initialize.php');
$page_title = 'Is database connected checker';
include(SHARED_PATH . '/header.php'); 

$recipes = recipe::find_by_category(1);

?>

<p><a href="login/login.php">Log in</a> or <a href="login/signup.php">Become a Member</a></p>

<h2>Welcome to Foody's Delight</h2>

<table border="1">
<tr>
        <th>recipe_id</th>
        <th>name</th>
        <th>cook_time</th>
        <th>instructions</th>
        <th>subcategory_id</th>
        <th>approved</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($recipes as $recipe) { ?>
        <tr>
          <td><?= h($recipe->recipe_id); ?></td>
          <td><?= h($recipe->name); ?></td>
          <td><?= h($recipe->cook_time); ?></td>
          <td><?= h($recipe->instructions); ?></td>

          <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id);
          foreach($subcategorys as $subcategory) { ?>
          <td><?= h($subcategory->subcategory_name); ?></td>
          <?php } ?>

          <td><?= h($recipe->approved($recipe->approved)); ?></td>
          <td><a class="action" href="<?= url_for('admins/members-editor/show.php?id=' . h(u($recipe->recipe_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/members-editor/edit.php?id=' . h(u($recipe->recipe_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/members-editor/delete.php?id=' . h(u($recipe->recipe_id))); ?>">Delete</a></td>
    <?php } ?>
    </tr>
</table>

    <?php  include(SHARED_PATH . '/footer.php'); ?>
