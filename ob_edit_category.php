<?php
  require_once('includes/authorize.php');
?>
<!DOCTYPE html>

<?php include "functions.php"; ?>
<?php include "db.php"; ?>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>
    
<body>
    <?php include "includes/admin_navbar.php"; ?> 

<?php
if(isset($_GET['edit_category'])){
    
    $category_id = escape($_GET['edit_category']);
    $query = "SELECT * FROM pagetable WHERE PageTableId = $category_id";  
           $select_query = mysqli_query($connection, $query);             
            while($row = mysqli_fetch_assoc($select_query)){
                $page_title = $row['PageTableName'];
                $blurb = $row['PageTableBlurb'];
  
         }
}
    
       if (isset($_POST['update_category'])) {
        
        $page_title          =  escape($_POST['page_title']);
        $blurb               =  escape($_POST['blurb']);

        $query = "UPDATE pagetable SET ";
        $query .="PageTableName = '{$page_title}', ";
        $query .="PageTableBlurb = '{$blurb}' ";
        $query .="WHERE PageTableId = {$category_id} ";
           
        $update_query = mysqli_query($connection,$query);
        confirm($update_query);

   
    }
        

?>

<form action="" method="post" enctype="multipart/form-data">    
    
    <div class="container">

        <div class="form-group">
            <label for="page_name">Page Name</label>
            <input type="text" value = "<?php echo $page_title?>" class="form-control" name="page_title">
        </div> 

        <div class="form-group">
            <label for="page_blurb">Blurb</label>
            <input type="text" value = "<?php echo $blurb?>" class="form-control" name="blurb">
        </div> 

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
        </div>
    </div>
</form>
        
<?php include "includes/footer.php"; ?>

</body>


