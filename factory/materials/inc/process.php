<?php require_once('../../private/initialize.php');

if (is_post_request()) {































  
  // *************** CATEGORIES
  if (isset($_POST['new_category'])) {
    $args = $_POST['category'];
    $args['created_by'] = $loggedInAdmin->id;

    $category = new MaterialCategory($args);
    $category->save();

    if ($category == true) :
      exit(json_encode(['success' => true, 'msg' => 'Category created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($category->errors)]));
    endif;
  }

  if (isset($_POST['edit_category'])) {
    $cId = $_POST['cId'];
    $args = $_POST['category'];
    $args['updated_at'] = date('Y-m-d H:i:s');

    $category = MaterialCategory::find_by_id($cId);

    $category->merge_attributes($args);
    $category->save();

    if ($category == true) :
      exit(json_encode(['success' => true, 'msg' => 'Category updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_category'])) {
    $cId = $_POST['cId'];
    $category = MaterialCategory::find_by_id($cId);
    $category::deleted($cId);

    if ($category == true) :
      exit(json_encode(['success' => true, 'msg' => 'Category deleted successfully!']));
    endif;
  }

  // *************** GROUPS
  if (isset($_POST['new_group'])) {
    $args = $_POST['group'];
    $args['created_by'] = $loggedInAdmin->id;

    $group = new MaterialGroup($args);
    $group->save();

    if ($group == true) :
      exit(json_encode(['success' => true, 'msg' => 'Material group created successfully!']));
    else :
      exit(json_encode(['success' => false, 'msg' => display_errors($group->errors)]));
    endif;
  }

  if (isset($_POST['edit_group'])) {
    $gId = $_POST['gId'];
    $args = $_POST['group'];
    $args['updated_at'] = date('Y-m-d H:i:s');

    $group = MaterialGroup::find_by_id($gId);

    $group->merge_attributes($args);
    $group->save();

    if ($group == true) :
      exit(json_encode(['success' => true, 'msg' => 'Material group updated successfully!']));
    endif;
  }

  if (isset($_POST['delete_group'])) {
    $gId = $_POST['gId'];
    $group = MaterialGroup::find_by_id($gId);
    $group::deleted($gId);

    if ($group == true) :
      exit(json_encode(['success' => true, 'msg' => 'Material group deleted successfully!']));
    endif;
  }
}


if (is_get_request()) {
  if (isset($_GET['get_category'])) :
    $cId = $_GET['cId'];
    $category = MaterialCategory::find_by_id($cId);
    exit(json_encode(['success' => true, 'data' => $category]));
  endif;

  if (isset($_GET['get_group'])) :
    $gId = $_GET['gId'];
    $category = MaterialGroup::find_by_id($gId);
    exit(json_encode(['success' => true, 'data' => $category]));
  endif;
}
