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
    
    $pdf_page_id = 0;
    if (isset($_GET['pdf_page_id'])) {
      $pdf_page_id = $_GET['pdf_page_id'];
    } else {
      die("Missing or invalid PDF page id");
    }

    $pdf_page = get_pdf_page($pdf_page_id);
    if ($pdf_page == null) {
      die("INVALID PDF page id");
    }

    error_log("***** PDF PAGE TITLE: {$pdf_page->get_title()} *****", 0);

    if(isset($_POST['update_pdf_page'])){
        $title             = escape($_POST['title']);
        if (trim($title) != trim($pdf_page->get_title())) {
          $pdf_page->set_title(trim($title));
        }

        $description       = escape($_POST['description']);
        if (trim($description) != trim($pdf_page->get_description())) {
          $pdf_page->set_description(trim($description));
        }

        $parent_id = $_POST['parent_id'];
        $pdf_page->set_parent_page_id($parent_id);

        $page_image        = escape($_FILES['page_image']['name']);
        if (trim($page_image) != "") {
          $pdf_page->set_image($page_image);
          $page_image_temp   = ($_FILES['page_image']['tmp_name']);
        }
        
        error_log("UPDATING PDF ID: { Type: $title, parent_id: $parent_id", 0);
        $result = update_pdf_page($pdf_page);
        // add_pdf_page($title, $description, $page_image, $parent_id);
        confirm($result);

        if ($page_image != "") {
          move_uploaded_file($page_image_temp,"$pdf_file_dir_path/$page_image");
        }
        $update_status = "Successfully added $title.";
    }
    
?>

<?php
    $redirect_func = "";
    if(isset($_POST['update_pdf_page'])) {
      $redirect_func = "<script>window.location = '/~bill/spoontest/ob_pdf_pages.php';</script>";
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
        <h4>Update PDF Page</h4>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="<?php echo $pdf_page->get_title() ?>" required>
        </div> 

        <div class="form-group">
            <label for="description">Description</label>
             <textarea class="form-control "name="description" id="" cols="30" rows="5" required><?php echo $pdf_page->get_description()?></textarea>
        </div>

        <div class="form-group">
            <label for="page_image">Image</label>
            <img src="<?= $pdf_file_dir ?>/<?= $pdf_page->get_image() ?>" width="100" alt="">
            <input type="file"  name="page_image">
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
                    $selected = '';
                    if ($pp->get_id() == $pdf_page->get_parent_page_id()) {
                      $selected = 'selected';
                    }
                    echo "<option $selected value='{$pp->get_id()}'>{$pp->get_title()}</option>";
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
        <input class="btn btn-primary" type="submit" name="update_pdf_page" value="Update PDF Page">
        <input class="btn btn-danger" type="button" onclick='javascript:history.back(1);' value="Cancel">
        </div>
        <input type="hidden" name="pdf_page_id" value="<?php echo $pdf_page->get_id() ?>">

    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
