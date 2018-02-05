<?php include "admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
 
        <?php include "admin_navigation.php" ?>
    

<div id="page-wrapper">

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

  <h1 class="page-header">
                Welcome to admin
                <small>Nancy Michele</small>
            </h1>
<?php

if(isset($_GET['source'])){

$source = $_GET['source'];

} else {

$source = '';

}

switch($source) {
    
    case 'add_product';
    
     include "add_product.php";
    
    break; 
    
    
    case 'edit_product';
    
    include "edit_product.php";
    break;
    
    
    default:
    include "view_all_product.php";
        
        ?>

<?php
    break;
    
}


?>

            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

     
        <!-- /#page-wrapper -->
        
  		
<?php include "includes/footer.php"; ?>