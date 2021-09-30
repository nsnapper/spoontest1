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
    error_log("ob_update_pdf_file");
    // TODO: This is a future to allow for nested pages.  0 == root page
    $parent_page_id = 0;
    if (isset($_GET['ppid'])) {
      $parent_page_id = $_GET['ppid'];
    }

    $pfid = 0;
    if (isset($_GET['pfid'])) {
      $pfid = $_GET['pfid'];
    } else {
      die("Missing or invalid PDF link id");
    }
    error_log("ob_update_pdf_file: FILEID: $pfid");
    $pdf_file = get_pdf_file($pfid);
    if ($pdf_file == null) {
      die("INVALID PDF file id");
    }
    error_log("update_pdf_file: File Title: {$pdf_file->get_title()}");
    
    if (isset($_POST['update_pdf_file'])) {
      error_log("ob_add_pdf_file: Updating Existing PDF with ID: $pfid...", 0);

      $title             = escape($_POST['title']);
      if (trim($title) != trim($pdf_file->get_title())) {
        $pdf_file->set_title(trim($title));
      }

      $pdf_page_id       = $_POST['pdf_page_id'];
      if (trim($pdf_page_id) != trim($pdf_file->get_pdf_page_id())) {
        $pdf_file->set_pdf_page_id($pdf_page_id);
      }

      // Thumbnail image for PDF file
      $pdf_image         = escape($_FILES['pdf_image']['name']);
      if (trim($pdf_image) != "") {
        $pdf_file->set_thumbnail_image($pdf_image);
        $pdf_image_temp    = ($_FILES['pdf_image']['tmp_name']);
      }
      
      // PDF file itself
      $pdf_filename         = escape($_FILES['pdf_filename']['name']);
      if (trim($pdf_filename) != "") {
        $pdf_file->set_pdf_file(trim($pdf_filename));
        $pdf_filename_temp    = ($_FILES['pdf_filename']['tmp_name']);
      }
      
      $result = update_pdf_file($pdf_file);
      confirm($result);
      if (trim($pdf_image) != "") {
        move_uploaded_file($pdf_image_temp,"$pdf_file_dir_path/$pdf_image");
      }
      if (trim($pdf_filename) != "") {
        move_uploaded_file($pdf_filename_temp,"$pdf_file_dir_path/$pdf_filename");
      }

      $update_status = "Successfully updated $title.";
    }
    
?>

<?php
    $redirect_func = "";
    if(isset($_POST['update_pdf_file'])) {
      $redirect_func = "<script>window.location = '{$app_root_dir}/ob_pdf_files.php';</script>";
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
<?php 
  if ($redirect_func != "") {
    echo($redirect_func);
  }
?>
        <h4>Update PDF File</h4>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="<?= $pdf_file->get_title() ?>" required>
        </div> 

        <div class="form-group">
            <label for="pdf_image">Image</label>
            <img src="<?= $pdf_file_dir ?>/<?= $pdf_file->get_thumbnail_image() ?>" width="100" alt="">
            <input type="file"  name="pdf_image" value="<?= $pdf_file->get_thumbnail_image() ?>">
        </div>

        <div class="form-group">
            <label for="pdf_filename">PDF File</label>
            <div style="display: inline-block">(Current File: <?= $pdf_file->get_pdf_file() ?>)</div>
            <input type="file" name="pdf_filename">
        </div>

        <div class="form-group">
          <label for="pdf_page-id">PDF Page for this file</label>
          <select name="pdf_page_id" id="">
            <?php
              // Get the PDF Page so we can get its parent to see what this could be linked to in case it's linked incorrectly
              $pdf_page = get_pdf_page($pdf_file->get_pdf_page_id());
              $pdf_page_id = $pdf_page->get_parent_page_id();

              $pdf_pages = get_pdf_pages_for_parent($pdf_page_id);
              echo("<option value=0>None</option>");
              if (count($pdf_pages) > 0) {
                foreach ($pdf_pages as &$pp) {
                  error_log("***** PP ID: {$pp->get_id()}  PDF PAGE ID: {$pdf_file->get_pdf_page_id()}");
                  $selected = "";
                  if ($pp->get_id() == $pdf_file->get_pdf_page_id()) {
                    $selected = "selected";
                  }
                  echo("<!-- Page Image: {$pp->get_image()} -->");
                  echo "<option $selected value='{$pp->get_id()}'>{$pp->get_title()}</option>";
                }
              } else {
                error_log("***** ERROR: NO PAGES");
              }
            ?>
          </select>
        </div>


        <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_pdf_file" value="Update PDF Page">
        <input class="btn btn-danger" type="button" onclick='javascript:history.back(1);' value="Cancel">
        </div>
    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
