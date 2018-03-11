<?php
  require_once('includes/authorize.php');
?>

<!DOCTYPE html>

<?php ob_start(); ?>
<?php include "functions.php"; ?>
<?php include "db.php"; ?>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>
    
<body>
    <?php include "includes/admin_navbar.php"; ?> 
    
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
<!--                            <small><?php echo $_SESSION['username']?></small>-->
                            <small>Whoever You Are</small>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
            <!-- /.container-fluid -->

    </div>
        <!-- /#page-wrapper -->

</body>

<?php include "includes/footer.php"; ?>



</html>
