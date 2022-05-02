<?php
  require_once('../../../private/initialize.php');

  if(is_post_request()) {

    // Create record using post parameters
    $category_name = strip_tags($_POST['category_name']);
    $category = new category;
    $result = $category->new_category($category_name);

    if($result === true) {
      $category = category::find_category_by_name($category_name);
      $new_id = $category->category_id;
      $_SESSION['message'] = 'The category was created successfully.';
      redirect_to(url_for('admins/category-editor/show.php?id=' . $new_id));
    } else {
      // show errors
    }

  } else {
    // display the form
    $category = new category;
  }

  $session->verify_user_level();
?>

<?php $page_title = 'Create a Category'; ?>
<?php include(SHARED_PATH . '/admin-header.php'); ?>
<div id="wrapper">
  <div id="form">
    <nav>
      <a href="index.php">&laquo; Back to List</a>
    </nav>

    <h1>Create Category</h1>

    <?=display_errors($category->errors); ?>

    <form action="<?=url_for('admins/category-editor/new.php'); ?>" method="post">

      <?php include('form-fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Create category" />
      </div>
    </form>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
