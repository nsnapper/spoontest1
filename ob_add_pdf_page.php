<?php
  require_once('includes/authorize.php');
?>
<DOCTYPE html>
<?php include "app_variables.php"; ?>

<?php include "functions.php"; ?>
<?php include "db.php"; ?>
<?php include "pdf_db_methods.php"; ?>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>
    
<body>
    <?php include "includes/admin_navbar.php"; ?> 
    
<?php
    
    $update_status = "";

    // TODO: This is a future to allow for nested pages.  0 == root page
    $parent_page_id = 0;
    if (isset($_GET['ppid'])) {
      $parent_page_id = $_GET['ppid'];
    }
    
    if(isset($_POST['add_pdf_page'])){
        //$pdf_page_id       = escape($_POST['page_id']);
        $title             = escape($_POST['title']);
        $description       = escape($_POST['description']);

        $parent_id = $_POST['parent_id'];

        $sort_index        = $_POST['sort_index'];

        $page_image        = escape($_FILES['page_image']['name']);
        $page_image_temp   = ($_FILES['page_image']['tmp_name']);
        move_uploaded_file($page_image_temp,"$pdf_file_dir_path/$page_image");
        
        error_log("Adding new PDF Type: $title, parent_id: $parent_id", 0);
        $result = add_pdf_page($title, $description, $page_image, $parent_id, $sort_index);
        confirm($result);

        $update_status = "Successfully added $title.";
    }
    
?>

<?php
    $redirect_func = "";
    if(isset($_POST['add_pdf_page'])) {
      $redirect_func = "<script>window.location = '{$app_root_dir}/ob_pdf_pages.php';</script>";
    }
?>

<?php
    if(isset($_POST['add_pdf_page'])) {
      echo($redirect_func);
    }
?>

<form action="" method="post" enctype="multipart/form-data">    
    <div class="container">
<?php
    if ($update_status != "") {
?>
      <p><b><i><?= $update_status ?></i></b></p>
<?php
    }
?>
        <h4>Add New PDF Page</h4>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div> 

        <div class="form-group">
            <label for="sort_index">Sort index</label>
            <input type="number" class="form-control" name="sort_index" value=1 required>
        </div> 

        <div class="form-group">
            <label for="description">Description</label>
             <textarea class="form-control "name="description" id="" cols="30" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="page_image">Image</label>
            <input type="file"  name="page_image" required>
        </div>

        <div class="form-group">
        <label for="parent_id-id">PDF Page This Shows On</label>
          <select name="parent_id" id="">
            <?php
                echo("<option value=0>None</option>");

                $pdf_pages = get_pdf_pages_for_parent($parent_page_id);
                if (count($pdf_pages) > 0) {
                  foreach ($pdf_pages as &$pp) {
                    echo("<!-- Page Image: {$pp->get_image()} -->");
                    echo "<option value='{$pp->get_id()}'>{$pp->get_title()}</option>";
                  }
                }
      
                // $query = "SELECT * FROM pdf_pages where parent_id=$parent_page_id ORDER BY title ASC";
                // echo("<!-- QUERY: $query -->");
                // $select_categories = mysqli_query($connection, $query); 
                // // confirm($select_categories);
                // if ($select_categories) {
                //   while($row = mysqli_fetch_assoc($select_categories)){
                //       $cat_id = $row['id'];
                //       $cat_title = $row['title'];

                //       echo "<option value='$cat_id'>{$cat_title}</option>";
                //   }
                // }
            ?>
          </select>
        </div>


        <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_pdf_page" value="Add PDF Page">
        <input class="btn btn-danger" type="button" onclick='javascript:history.back(1);' value="Cancel">
        </div>
    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
