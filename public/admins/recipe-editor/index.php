<?php 
require_once('../../../private/initialize.php');
$page_title = "Foody's Delight: Recipes editor";
include(SHARED_PATH . '/admin-header.php');  

if(is_post_request()) {
  $boolean = $_POST['boolean'] ?? '';

  if($boolean == 'y') { 
    $recipes = recipe::find_recipes(TRUE); 
  } elseif($boolean == 'n') {
    $recipes = recipe::find_recipes(FALSE); 
  } 
} else { 
  $recipes = recipe::find_all(); 
}

$session->verify_user_level();
?>

<a class="back-link" href="../index.php">&laquo; Back to Main Menu</a><br>

<form action="index.php" method="post">
    Sort by Approved:<br>
    <select id="cars" name="cars">
      <option name="boolean" value="">Both</option>
      <option name="boolean" value="n">No</option>
      <option name="boolean" value="y">Yes</option>
    </select><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

<a class="action" href="new.php">Create New Member</a>
<table border="1">
  <tr>
        <th>recipe_id</th>
        <th>name</th>
        <th>cook_time</th>
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
          <td><?= h($recipe->approved($recipe->approved)); ?></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/show.php?id=' . h(u($recipe->recipe_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/edit.php?id=' . h(u($recipe->recipe_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/delete.php?id=' . h(u($recipe->recipe_id))); ?>">Delete</a></td>
    <?php } ?>
    </tr>
</table>




    <?php  include(SHARED_PATH . '/footer.php'); ?>
