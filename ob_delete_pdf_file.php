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
error_log("ob_delete_pdf_file...", 0);
if (isset($_POST['delete'])) {
  $pfid = $_POST['pfid'];
  $result = delete_pdf_file($pfid);
  confirm($result);
  header("Location: ob_pdf_files.php");
}
?>

</body>
</html>
