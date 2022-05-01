<?php 
  require_once('../../../private/initialize.php'); 
  $id = $_GET['id'] ?? '1'; // PHP > 7.0
  $recipe = recipe::find_by_recipe_id($id);
  $page_title = 'Show All Users: ';
  include(SHARED_PATH . '/admin-header.php'); 
  $session->verify_user_level();

  $msg = "";
  $string = "";
  $msg = $session->message($string);
?>

<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <?php if(!is_blank($msg)) { ?>
      <p id="msg"><?= $msg; ?></p>
    <?php } else {} ?>

    <h2>Recipe: <?= h($recipe->name); ?></h2>

    <h3>Uploaded Image:</h3>
    <?php $uploaded_image = uploadedimage::find_by_recipe_id($id); ?>
    <img class="show-image" src="<?= url_for('uploaded-images/' . h($uploaded_image->uploaded_image)); ?>" alt="">


      
        <h3>Recipe ID:</h3>
        <p><?= h($recipe->recipe_id); ?></p>
      
      <h3>Cook Time:</h3>
      <p><?= h($recipe->cook_time); ?></p>

      <h3>Amounts, Measurements, And Ingredients:</h3>
      <?php 
        $ingredients = ingredient::find_by_recipe_id($id);
        foreach($ingredients as $ingredient) { 
          $measurements = measurement::find_by_recipe_id($id, $ingredient->ingredient_id);
          foreach($measurements as $measurement) {
      ?>
        <p><?= h($measurement->amount); ?> <?= h($measurement->measurement); }?> <?= h($ingredient->ingredient_name); ?></p>
      <?php } ?>

      <h3>Instructions:</h3>
      <?php
        $steps = $recipe->instructions($recipe->instructions);
        $i = 1;
        foreach($steps as $step) { 
      ?>
        <h4>Step <?= h($i++); ?></h4>
        <p><?= h($step); ?></p>
      <?php } ?>

      <h3>Subcategory:</h3>
      <?php
        $subcategorys = subcategory::find_subcategory_name($recipe->subcategory_id);
        foreach($subcategorys as $subcategory) {
      ?>
        <p><?= h($subcategory->subcategory_name); ?></p>
      <?php } ?>

      
        <h3>Approved:</h3>
        <p><?= h($recipe->approved($recipe->approved)); ?></p>

        <h3>Cards Appearances:</h3>
        <h4>General View</h4>
        <?php 
          $recipes = recipe::find_by_recipe_id_card($id); 
          include(SHARED_PATH . '/recipes.php');
        ?>
        <h4>Member View</h4>
        <?php include(SHARED_PATH . '/member-recipes.php'); ?>
      
  </div>
</div>

<?php  include(SHARED_PATH . '/footer.php'); ?>
