<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  $page_title = 'Show All Users: ';
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();
?>

  <a class="back-link" href="index.php">&laquo; Back to List</a>

    <h1>Recipe: <?= h($recipe->name); ?></h1>

      <dl>
        <dt>Recipe ID</dt>
        <dd><?= h($recipe->recipe_id); ?></dd>
      </dl>
      <dl>
      <dl>
        <dt>Name</dt>
        <dd><?= h($recipe->name); ?></dd>
      </dl>
      <dl>
        <dt>Cook Time</dt>
        <dd><?= h($recipe->cook_time); ?></dd>
      </dl>
      <dl>
        <dt>Instructions</dt>
        <?php
          $steps = $recipe->instructions($recipe->instructions);
          $i = 1;
          foreach($steps as $step) { 
        ?>
          <dd>Step <?= h($i++); ?> <?= h($step); ?></dd>
        <?php } ?>
      </dl>
      <dl>
        <dt>Subcategory</dt>
        <?php $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id);
          foreach($subcategorys as $subcategory) { ?>
            <dd><?= h($subcategory->subcategory_name); ?></dd>
          <?php } ?>
      </dl>
      <dl>
        <dt>Approved</dt>
        <dd><?= h($recipe->approved($recipe->approved)); ?></dd>
      </dl>
      <dl>
    </div>

  </div>

</div>
