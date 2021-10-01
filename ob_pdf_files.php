<!DOCTYPE html>

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
function build_delete_file_form($pfid) {
  error_log("building delete...", 0);
  $dpf = "
    <form action='ob_delete_pdf_file.php' method='post'>
      <input type='hidden' name='pfid' value='{$pfid}'>
      <input class='btn btn-danger' type='submit' name='delete' value='Delete Page' onClick=\"javascript: return confirm('Are you sure you want to delete this file?'); \">
    </form>    
  ";
  return $dpf;
}
?>

<?php 
$pfid = null;
if (isset($_GET['pfid'])) {
  $pfid = $_GET['pfid'];
}

$pdf_parent_pages = get_pdf_pages_for_parent(0);
// echo("<script>alert('Found " . count($pdf_parent_pages) . " parent pages...');</script>");
$ppid = 100;
if (isset($_GET['ppid'])) {
  $ppid = $_GET['ppid'];
} else {
  $ppid = $pdf_parent_pages[0]->get_id();
}

// TODO: Replace 100 with dynamically computed value.
$pdf_pages = get_pdf_pages_for_parent($ppid);
if ($pfid == null) {
  $pfid = $pdf_pages[0]->get_id();
  error_log("***** SET DEFAULT VALUE == $pfid", 0);
}
// echo("<script>alert('Getting pdf pages for parent " . $ppid . "  pfid == $pfid...');</script>");

?>

<h4 style="display: inline-block" class="catalog_heading">PDF Files</h4>
<a style="display: inline-block" class="btn btn-primary" href="ob_add_pdf_file.php?ppid=<?= $ppid ?>">Upload PDF File</a>
<select style="margin-left: 10px" name="parent_page" id="parent_page" onchange="window.location = 'ob_pdf_files.php?ppid='+this.value;">
<?php
  $parent_title = "Self";
  foreach ($pdf_parent_pages as &$ppp) {
    $selected = "";
    if ($ppp->get_id() == $ppid) {
      $selected = "selected";
      $parent_title = $ppp->get_title();
    }
    echo "<option $selected value='{$ppp->get_id()}'>{$ppp->get_title()}</option>";
  }
?>
</select>
<select style="margin-left: 10px" name="pdf_page_id" id="" onchange="window.location = 'ob_pdf_files.php?pfid='+this.value+'&ppid='+<?=$ppid?>;">
<?php
// echo("<option value=0>None</option>");
if (count($pdf_pages) > 0) {
  $current_catalog = "";
  echo("<option value='$ppid'>$parent_title</option>");
  foreach ($pdf_pages as &$pp) {
    $selected = "";
    if ($pp->get_id() == $pfid) {
      $selected = "selected";
      $current_catalog = $pp->get_title();
    }
    echo("<!-- Page Image: {$pp->get_image()} -->");
    echo "<option $selected value='{$pp->get_id()}'>{$pp->get_title()}</option>";
  }
}
?>
</select>
<!-- </div> -->
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id / Sort Index</th>
            <th>Title</th>
            <th>Thumbnail</th>
            <th>PDF Filename</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

    </thead>
    <tbody>
        <?php
            $pdf_links = get_pdf_files_for_page($pfid);
            if (count($pdf_links) > 0) {
              foreach ($pdf_links as &$pl) {
                $pfid = $pl->get_id();
                echo "<tr>";
                echo "<td>{$pl->get_id()} / {$pl->get_sort_index()}</td>";
                echo "<td>{$pl->get_title()}</td>";
                echo "<td><img width='100' src='$pdf_file_dir/{$pl->get_thumbnail_image()}' alt='file'></td>";                
                echo "<td>{$pl->get_pdf_file()}</td>";
                echo "<td><a class='btn btn-info' href='ob_update_pdf_file.php?pfid={$pl->get_id()}'>Edit</a></td>"; 
                $del_btn = build_delete_file_form($pfid);
                // echo $del_btn;
                echo "<td>$del_btn</td>"; 
                echo "</tr>";
                // echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this product?'); \" href='ob_products.php?delete={$system_id}'>Delete</a></td>"; 

              }
            } else {
              echo("<h4 style='padding-top: 20px;text-align: center'>No PDF Files have been added to the category '$current_catalog'</h4");
            }
        ?>

      </tbody>

</table>
    </body>
        <?php include "includes/footer.php"; ?>


<?php

    // if(isset($_GET['delete'])){
        
    //     $system_id = $_GET['delete'];
    //     $query = "DELETE FROM websitelayout WHERE System_ID = {$system_id}";
    //     $delete_query = mysqli_query($connection, $query);
    //     confirm($delete_query);
    //     header("Location: ob_products.php");

    // }
?>

