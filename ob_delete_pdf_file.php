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

<?php
  logger(DEBUG_LEVEL, "ob_delete_pdf_file...");
if (isset($_POST['delete'])) {
  $pfid = $_POST['pfid'];
  $ppid = $_POST['ppid'];

  $pdf_file = get_pdf_file($pfid);

  $result = delete_pdf_file($pfid);
  confirm($result);
  header("Location: ob_pdf_files.php?ppid={$ppid}&pfid={$pdf_file->get_pdf_page_id()}");
}
?>

</body>
</html>
