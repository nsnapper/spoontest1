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
logger(DEBUG_LEVEL, "ob_delete_pdf_page...");
if (isset($_POST['delete'])) {
  $ppid = $_POST['ppid'];
  $result = delete_pdf_page($ppid);
  confirm($result);
  header("Location: ob_pdf_pages.php");
}
?>

</body>
</html>
