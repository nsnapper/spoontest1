<?php include "app_variables.php"; ?>
<?php
  require_once('includes/authorize.php');
?>
<DOCTYPE html>

<?php include "functions.php"; ?>
<?php include "db.php"; ?>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>
    
<body>
    <?php include "includes/admin_navbar.php"; ?> 
    
<?php
    
    $update_status = "";
    if(isset($_POST['add_product'])){
        $display_page      = escape($_POST['display_page']);
        $sort_order        = escape($_POST['sort_order']);
        $prod_title        = escape($_POST['prod_title']);
        $prod_image        = escape($_FILES['prod_image']['name']);
        $prod_image_temp   = ($_FILES['prod_image']['tmp_name']);
        $blurb             = escape($_POST['blurb']);
        $link_to           = escape($_POST['link_to']);
        move_uploaded_file($prod_image_temp,"cms_images/$prod_image");
        
        $query = "INSERT INTO websitelayout(ProdPageTableId, ProdPageSortOrder, ProdPageTitle, ProdPageImage, ProdPageBlurb, ProdPageLinkTo)";
        
        $query .="VALUES('{$display_page}', '{$sort_order}','{$prod_title}', '{$prod_image}','{$blurb}','{$link_to}')";
        

        $add_product_query = mysqli_query($connection, $query);

        confirm($add_product_query);
        $update_status = "Successfully added $prod_title.";
    }
    
?>

<?php
    $redirect_func = "";
    if(isset($_POST['add_product'])) {
      $redirect_func = "<script>window.location = '/~bill/spoontest/ob_products.php';</script>";
    }

?>

<form action="" method="post" enctype="multipart/form-data">    
    <div class="container">
<?php
    if ($update_status != "") {
?>
      <p><b><i><?= $update_status ?></i></b></p>
<?php
    }
?>
        <h4>Add New Product</h4>
        <div class="form-group">
            <select name="display_page" id="">

                <?php
                   $query = "SELECT * FROM pagetable ORDER BY PageTableName ASC";  
                    $select_categories = mysqli_query($connection, $query); 
                    confirm($select_categories);

                    while($row = mysqli_fetch_assoc($select_categories)){
                        $cat_id = $row['PageTableId'];
                        $cat_title = $row['PageTableName'];

                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                ?>
            </select>
        </div>



        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="text" class="form-control" name="sort_order" required>
        </div> 
        <div class="form-group">
            <label for="prod_title">Title</label>
            <input type="text" class="form-control" name="prod_title" required>
        </div> 

        <div class="form-group">
            <label for="page_image">Image</label>
            <input type="file"  name="page_image" required>
        </div>

        <div class="form-group">
            <label for="blurb">Blurb</label>
             <textarea class="form-control "name="blurb" id="" cols="30" rows="5" required></textarea>
         </div>

            <div class="form-group">
            <select name="link_to" id="">
                <?php
                    $query = "SELECT * FROM pagetable ORDER BY PageTableName ASC";  
                    $select_categories = mysqli_query($connection, $query); 
                    confirm($select_categories);

                    while($row = mysqli_fetch_assoc($select_categories)){
                        $cat_id = $row['PageTableId'];
                        $cat_title = $row['PageTableName'];

                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                ?>
            </select>
        </div>


        <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_product" value="Add Product">
        <input class="btn btn-danger" type="button" onclick='javascript:history.back(1);' value="Cancel">
        </div>
    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
