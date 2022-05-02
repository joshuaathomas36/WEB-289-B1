<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $subcategory_name = strip_tags($_POST['subcategory_name']) ?? '';
    $category_id = $_POST['category_id'] ?? 0;
    $subcategory = new subcategory;
    $result = $subcategory->new_subcategory($subcategory_name, $category_id);

    if($result === true) {
      $subcategory = subcategory::find_subcategory_by_name($subcategory_name);
      $new_id = $subcategory->subcategory_id;
      $_SESSION['message'] = 'The subcategory was created successfully.';
      redirect_to(url_for('admins/subcategory-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $subcategory = new subcategory;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Subcategory'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Subcategory</h1>

    <?=display_errors($subcategory->errors); ?>

    <form action="<?=url_for('admins/subcategory-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create subcategory" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
