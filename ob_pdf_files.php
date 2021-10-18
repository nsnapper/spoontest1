<?php
  require_once('includes/authorize.php');
?>

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
function build_delete_file_form($ppid, $pfid) {
  $dpf = "
    <form action='ob_delete_pdf_file.php' method='post'>
    <input type='hidden' name='ppid' value='{$ppid}'>
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
//echo("<script>alert('PDF ROOT: $storage_web_app_root');</script>");
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
  logger(DEBUG_LEVEL, "***** SET DEFAULT VALUE == $pfid");
}
// echo("<script>alert('Getting pdf pages for parent " . $ppid . "  pfid == $pfid...');</script>");

?>

<h4 style="display: inline-block" class="catalog_heading">Showing PDF Files for: </h4>
<select style="margin-left: 10px" name="parent_page" id="parent_page" onchange="window.location = 'ob_pdf_files.php?ppid='+this.value;">
<?php
  $parent_title = "Self";
  foreach ($pdf_parent_pages as &$ppp) {
    $selected = "";
    if ($ppp->get_id() == $ppid) {
      $selected = "selected";
      $parent_title = $ppp->get_title();
      if ($ppp->get_parent_page_id() == 0) {
        $parent_title .= " (top catalog page)";
      }
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
<br />
<div style="margin-left: 10px">
<a style="display: inline-block" class="btn btn-primary" href="ob_add_pdf_file.php?ppid=<?= $ppid ?>&pfid=<?= $pfid ?>">Upload New PDF File</a>
</div>
<!-- </div> -->
<table class="table table-bordered table-hover">
<?php
  $sort_by = TITLE;
  if (isset($_GET['sort_by']) && $_GET['sort_by'] != "") {
    $sort_by = $_GET['sort_by'];
  }
  $sort_dir = 'asc';
  if (isset($_GET['sort_dir']) && $_GET['sort_dir'] != "") {
    $sort_dir = $_GET['sort_dir'];
  }

  // Get the PDF files for the specified page.
  $pdf_links = get_pdf_files_for_page($pfid, $sort_dir, $sort_by);

  if ($sort_dir == 'asc') {
    $sort_dir = 'desc';
  } else {
    $sort_dir = 'asc';
  }

  function build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title) {
    $sortArrow = "";
    if ($add_dir_caret) {
      if ($sort == 'asc') {
        $sortArrow = " v";
      } else {
        $sortArrow = " ^";
      }
    }
    return "<a href=ob_pdf_files.php?sort_by=$col_name&sort_dir=$sort>$col_title$sortArrow</a>";
  }
  function build_column_header($col_name, $col_title) {
    global $sort_dir, $sort_by;
    // $sort_by = $col_name;
    $col_hdr = $col_title;
    $add_dir_caret = false;
    if ($sort_by == $col_name) {
      $sort = $sort_dir;
      $add_dir_caret = true;
    } else {
      $sort = 'asc';
    }
    logger(DEBUG_LEVEL, "*** build_column_header: SortBy: $sort_by,  ColName: $col_name, Sort Dir: $sort");
    switch ($col_name) {
      case ID:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case TITLE:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case THUMBNAIL_IMAGE:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PDF_FILE:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PDF_PAGE_ID:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case SORT_INDEX:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      default:
        $sort_by = ID;
    }
    return $col_hdr;
  }
?>
  
    <thead>
        <tr>
            <th><?= build_column_header(SORT_INDEX, "Sort Index") ?></th>
            <th><?= build_column_header(TITLE, "Title") ?></th>
            <th><?= build_column_header(THUMBNAIL_IMAGE, "Thumbnail") ?></th>
            <th><?= build_column_header(PDF_FILE, "PDF Filename") ?></th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

    </thead>
    <tbody>
        <?php
            if (count($pdf_links) > 0) {
              foreach ($pdf_links as &$pl) {
                $pfid = $pl->get_id();
                echo "<tr>";
                echo "<td>{$pl->get_sort_index()}</td>";
                echo "<td>{$pl->get_title()}</td>";
                echo "<td>";
                if ($pl->get_thumbnail_image() != null) {
                  echo("<img width='100' src='$app_root_dir/$storage_web_app_root/$pdf_file_dir_path/{$pl->get_thumbnail_image()}' alt='file'>");
                } else {
                  echo " N/A ";
                }
                echo "</td>";
                echo "<td>{$pl->get_pdf_file()}</td>";
                echo "<td><a class='btn btn-info' href='ob_update_pdf_file.php?pfid={$pl->get_id()}'>Edit</a></td>"; 
                $del_btn = build_delete_file_form($ppid, $pfid);
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

