<?php 
  require_once('../../../private/initialize.php');
  $page_title = "Recipes editor";
  include(SHARED_PATH . '/admin-header.php');  

  if(is_post_request()) {
    $boolean = $_POST['boolean'] ?? '';

    if($boolean == 'y') { 
      $recipes = recipe::find_recipes(TRUE); 
    } elseif($boolean == 'n') {
      $recipes = recipe::find_recipes(FALSE); 
    } else { 
      $recipes = recipe::find_all(); 
    }
  } else { 
    $recipes = recipe::find_all(); 
  }

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

    <form action="index.php" method="post">
      Sort by what's Approved:<br>
      <select id="boolean" name="boolean">
        <option name="boolean" value="">Both</option>
        <option name="boolean" value="n">No</option>
        <option name="boolean" value="y">Yes</option>
      </select>
      <input type="submit" name="submit" value="Submit"  />
    </form>

    <a class="action" href="new.php">Create New Recipe</a>
    <table class="admin-table" border="1">
      <tr>
        <th>Recipe ID</th>
        <th>Name</th>
        <th>Cook Time</th>
        <th>Approved</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Approve</th>
      </tr>

      <?php foreach($recipes as $recipe) { ?>
        <tr>
          <td><?= h($recipe->recipe_id); ?></td>
          <td><?= h($recipe->name); ?></td>
          <td><?= h($recipe->cook_time); ?></td>
          <td><?= h($recipe->approved($recipe->approved)); ?></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/show.php?id=' . h(u($recipe->recipe_id))); ?>">View</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/edit.php?id=' . h(u($recipe->recipe_id))); ?>">Edit</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/approve.php?id=' . h(u($recipe->recipe_id))); ?>">Approve</a></td>
          <td><a class="action" href="<?= url_for('admins/recipe-editor/delete.php?id=' . h(u($recipe->recipe_id))); ?>">Delete</a></td>
        <?php } ?>
        </tr>
    </table>
  </div>
</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
