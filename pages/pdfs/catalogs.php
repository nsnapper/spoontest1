<!DOCTYPE html>
<?php include "../../app_variables.php"; ?>
<?php include "../../db.php"; ?>
<?php include "../../pdf_db_methods.php"; ?>
<html lang="en">

<head>
<?php include "../../includes/common_head.php"; ?>
</head>


<body>
    <?php include "../../includes/logo.php"; ?>

<div id="pdf_lists">
    <!-- List links to individual sections that are siblings of this page. -->
    <?php
      $pdf_page_id = null;
      if (isset($_GET['ppid'])) {
        $pdf_page_id = $_GET['ppid'];
      }    
      if ($pdf_page_id == null) {
        die("Missing PDF ID.");
      }
      $pp = get_pdf_page($pdf_page_id);
    ?>
    <h4 class="catalog_heading"><?= $pp->get_title() ?></h4>
    <?php
      // List links to PDF files that should be on this page.
      // Fetch list of PDFs for this catalog type.
      $pdf_pages = get_pdf_files_for_page($pdf_page_id);
      if (count($pdf_pages) > 0) {
        echo("<ul class='list-group'>");

        foreach ($pdf_pages as &$pp) {
          echo("<li class='list-group-item'><a href='$app_root_dir/$storage_web_app_root/$pdf_file_dir_path/{$pp->get_pdf_file()}'><img width='100' src='$app_root_dir/$storage_web_app_root/$pdf_file_dir_path/{$pp->get_thumbnail_image()}' alt='images'><span class='pdf_link'>{$pp->get_title()}</span></a></li>");
        }
        echo("</ul>");
      } else {
        echo("<li class='list-group-item'>No entries found for this type of catalog.</li>");
      }

      $pdf_parent_page = get_pdf_page($pdf_page_id);
      $pdf_pages = get_pdf_pages_for_parent($pdf_page_id);
      if (count($pdf_pages) > 0) {
        echo("<ul class='list-group'>");
        foreach ($pdf_pages as &$pp) {
          echo("<!-- Page Image: {$pp->get_image()} -->");
          echo("<li class='list-group-item'><a href='catalogs.php?ppid={$pp->get_id()}'><img width='100' src='" . "$app_root_dir/$storage_web_app_root/$pdf_file_dir_path/{$pp->get_image()}" . "' alt='images'><span class='pdf_link'>{$pp->get_title()}</span></a></li>");
        }
        echo("</ul>");
      } else {
        // Root pages are expected to have sibling pages.  This could change...
        if ($pdf_parent_page->get_parent_page_id() == 0) {
          echo("<li class='list-group-item'>No catalog pages found...</li>");
        }
      }
    ?>
</div>

<div>
    <?php include "../../includes/footer.php";  ?>
</div>
</body>
