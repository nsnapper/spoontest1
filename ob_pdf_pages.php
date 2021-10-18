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
function build_delete_page_form($ppid) {
  $dpf = "
    <form action='ob_delete_pdf_page.php' method='post'>
      <input type='hidden' name='ppid' value='{$ppid}'>
      <input class='btn btn-danger' type='submit' name='delete' value='Delete Page' onClick=\"javascript: return confirm('Are you sure you want to delete this page?'); \">
    </form>    
  ";
  return $dpf;
}
?>

<h4 style="display: inline-block" class="catalog_heading">PDF Pages</h4>
<a style="display: inline-block" class="btn btn-primary" href="ob_add_pdf_page.php">Add PDF Page</a>
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
  $pdf_pages = get_all_pdf_pages($sort_dir, $sort_by);

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
    return "<a href=ob_pdf_pages.php?sort_by=$col_name&sort_dir=$sort>$col_title$sortArrow</a>";
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
      case PAGE_ID:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PAGE_TITLE:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PAGE_THUMBNAIL_IMAGE:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PAGE_PARENT_ID:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      case PAGE_SORT_INDEX:
        $col_hdr = build_col_hdr_link($add_dir_caret, $sort, $col_name, $col_title);
        break;

      default:
        $sort_by = PAGE_ID;
    }
    return $col_hdr;
  }
?>

    <thead>
        <tr>
            <th><?= build_column_header(PAGE_SORT_INDEX, "Sort Index") ?></th>
            <th><?= build_column_header(PAGE_TITLE, "Title") ?></th>
            <th><?= build_column_header(PAGE_PARENT_ID, "Parent Page") ?></th>
            <th><?= build_column_header(PAGE_THUMBNAIL_IMAGE, "Image") ?></th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

    </thead>
    <tbody>
        <?php
          function get_parent($pp_arr, $pid) {
            for($i = 0; $i < count($pp_arr); $i++) {
              if ($pp_arr[$i]->get_id() == $pid) {
                return $pp_arr[$i];
              }
            }
            return null;
          }
            if (count($pdf_pages) > 0) {
              foreach ($pdf_pages as &$pp) {
                $ppid = $pp->get_id();
                echo "<tr>";
                echo "<td>{$pp->get_sort_index()}</td>";
                echo "<td>{$pp->get_title()}</td>";

                if ($pp->get_parent_page_id() == 0) {
                  echo "<td>Top Page</td>";
                } else {
                  // echo "<td>{$pp->get_parent_page_id()}</td>";
                  $p = get_parent($pdf_pages, $pp->get_parent_page_id());
                  echo "<td>{$p->get_title()} ({$p->get_id()})</td>";
                }
                echo "<td><img width='100' src='$app_root_dir/$storage_web_app_root/$pdf_file_dir_path/{$pp->get_image()}' alt='images'></td>";
                echo "<td><a class='btn btn-info' href='ob_update_pdf_page.php?pdf_page_id={$pp->get_id()}'>Edit</a></td>"; 
                $del_btn = build_delete_page_form($ppid);
                // echo $del_btn;
                echo "<td>$del_btn</td>"; 
                echo "</tr>";
                // echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this product?'); \" href='ob_products.php?delete={$system_id}'>Delete</a></td>"; 

              }
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

