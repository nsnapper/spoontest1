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
    error_log("ob_add_pdf_file");
    // TODO: This is a future to allow for nested pages.  0 == root page
    $ppid = 0;
    $pfid = 0;
    if (isset($_GET['ppid'])) {
      $ppid = $_GET['ppid'];
    }

    if (isset($_GET['pfid'])) {
      $pfid = $_GET['pfid'];
    }
    
    if (isset($_POST['add_pdf_file'])) {
      error_log("ob_add_pdf_file: Adding new PDF...", 0);

      $title             = escape($_POST['title']);
      $description       = escape($_POST['description']);

      $sort_index        = $_POST['sort_index'];
      
      $pdf_page_id       = $_POST['pdf_page_id'];

      // Thumbnail image for PDF file
      $pdf_image         = escape($_FILES['pdf_image']['name']);
      $pdf_image_temp    = ($_FILES['pdf_image']['tmp_name']);
      move_uploaded_file($pdf_image_temp,"$pdf_file_dir_path/$pdf_image");
      
      // PDF file itself
      $pdf_filename         = escape($_FILES['pdf_filename']['name']);
      $pdf_filename_temp    = ($_FILES['pdf_filename']['tmp_name']);
      move_uploaded_file($pdf_filename_temp,"$pdf_file_dir_path/$pdf_filename");
      
      $result = add_pdf_file($title, $pdf_image, $pdf_filename, $pdf_page_id, $sort_index);
      confirm($result);
      $update_status = "Successfully added $title.";
    }
    
?>

<?php
    $redirect_func = "";
    if(isset($_POST['add_pdf_file'])) {
      $redirect_func = "<script>window.location = '{$app_root_dir}/ob_pdf_files.php?ppid={$ppid}&pfid={$pfid}';</script>";
    }

?>

<?php 
  if ($redirect_func != "") {
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
        <h4>Add New PDF File</h4>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div> 

        <div class="form-group">
            <label for="sort_index">Sort index</label>
            <input type="number" class="form-control" name="sort_index" value=1 required>
        </div> 

        <div class="form-group">
            <label for="pdf_image">Image</label>
            <input type="file"  name="pdf_image" accept="image/png, image/jpeg, image/jpg" required>
        </div>

        <div class="form-group">
            <label for="pdf_filename">PDF File</label>
            <input type="file"  name="pdf_filename" accept=".pdf" required>
        </div>

        <div class="form-group">
          <label for="pdf_page-id">PDF Page for this file</label>
          <select name="pdf_page_id" id="">
            <?php
                $query = "SELECT * FROM pdf_pages ORDER BY title ASC";
                echo("<!-- QUERY: $query -->");
                $select_categories = mysqli_query($connection, $query); 
                // confirm($select_categories);
                if ($select_categories) {
                  while($row = mysqli_fetch_assoc($select_categories)){
                      $selected = "";
                      $cat_id = $row['id'];
                      $cat_title = $row['title'];
                      if ($cat_id == $pfid) {
                        $selected = "selected";
                      }
                      echo "<option $selected value='$cat_id'>{$cat_title}</option>";
                  }
                }
                echo("<option value=0>None</option>");
            ?>
          </select>
        </div>


        <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_pdf_file" value="Add PDF Page">
        <input class="btn btn-danger" type="button" onclick='javascript:history.back(1);' value="Cancel">
        </div>
    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
