<!DOCTYPE html>
<?php include "app_variables.php"; ?>
<?php include "db.php"; ?>
<?php include "pdf_db_methods.php"; ?>
<head>
    <?php include "includes/common_head.php"; ?>
</head>

<html lang="en">

  <body>

    <?php include "includes/logo.php"; ?>

     
<div id="pdf_lists">
    <h4 class="catalog_heading">Spoontiques Product Catalogs - per region</h4>
    <ul class="list-group">
        <?php
          $pdf_pages = get_pdf_pages_for_parent(0);
          if (count($pdf_pages) > 0) {
            foreach ($pdf_pages as &$pp) {
              echo("<!-- Page Image: {$pp->get_image()} -->");
              echo("<li class='list-group-item'><a href='pages/pdfs/catalogs.php?ppid={$pp->get_id()}'><img width='100' src='" . "site_images/{$pp->get_image()}" . "' alt='images'><span class='pdf_link'>{$pp->get_title()}</span></a></li>");
            }
          } else {
            echo("<li class='list-group-item'>No pages found...</li>");
          }
        ?>
   </ul>    
   
</div>

<div>
    <?php include "../../includes/footer.php";  ?>
</div>
</body>

</html>
