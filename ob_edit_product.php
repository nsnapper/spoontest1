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

    if (isset($_GET['edit_product'])){
        $product_id = escape($_GET['edit_product']);
    }

 
    $query = "SELECT * FROM websitelayout WHERE System_ID = $product_id";  

    $select_query = mysqli_query($connection, $query);   
    $select_count = mysqli_num_rows($select_query);

    while($row = mysqli_fetch_assoc($select_query)){
        $display_page = $row['ProdPageTableId'];
        $sort_order =   $row['ProdPageSortOrder'];
        $prod_title =   $row['ProdPageTitle'];
        $prod_image =   $row['ProdPageImage'];
        $blurb =        $row['ProdPageBlurb'];
        $link_to =      $row['ProdPageLinkTo'];
    }

    $query = "SELECT * FROM pagetable WHERE PageTableId = $display_page";  
    $select_query = mysqli_query($connection, $query); 
    confirm($select_query);

    while($row = mysqli_fetch_assoc($select_query)){
        $display_page_title = $row['PageTableName'];
    }
    
    $query = "SELECT * FROM pagetable WHERE PageTableId = $link_to";  
    $select_query = mysqli_query($connection, $query); 
    confirm($select_query);

    while($row = mysqli_fetch_assoc($select_query)){
        $link_to_page_title = $row['PageTableName'];
    }


    if (isset($_POST['update_product'])) {
        
        $display_page      = escape($_POST['display_page']);
        $sort_order        = escape($_POST['sort_order']);
        $prod_title        = escape($_POST['prod_title']);
        $prod_image        = ($_FILES['prod_image']['name']);
        $prod_image_temp   = ($_FILES['prod_image']['tmp_name']);
        $blurb             = escape($_POST['blurb']);
        $link_to           = escape($_POST['link_to']);
        move_uploaded_file($prod_image_temp,"images/$prod_image");
        
        if(empty($prod_image)) {
            $query = "SELECT * FROM websitelayout WHERE System_ID = $product_id"; 
            $select_image = mysqli_query($connection,$query);
            $select_count = mysqli_num_rows($select_image);
            while($row = mysqli_fetch_array($select_image)){
                $prod_image = $row['ProdPageImage'];
            }
        }
       
   
        $query = "UPDATE websitelayout SET ";
        $query .="ProdPageTableId = '{$display_page}', ";
        $query .="ProdPageSortOrder = '{$sort_order}', ";
        $query .="ProdPageTitle = '{$prod_title}', ";
        $query .="ProdPageImage = '{$prod_image}', ";
        $query .="ProdPageBlurb = '{$blurb}', ";
        $query .="ProdPageLinkTo = '{$link_to}' ";
        $query .="WHERE System_ID = {$product_id} ";


        $update_product = mysqli_query($connection,$query);
        confirm($update_product);
     }
 
        
    
?>
    
<form action="" method="post" enctype="multipart/form-data">         
    <div class="container">

        <div class="form-group">
            <select name="display_page" id="">
                <option value='<?php echo $display_page ?>'><?php echo $display_page_title?></option>

                <?php
                $query = "SELECT * FROM pagetable ORDER BY PageTableName ASC";  

                $select_categories = mysqli_query($connection, $query); 
                confirm($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = escape($row['PageTableId']);
                    $cat_title = escape($row['PageTableName']);

                    if($cat_id == $display_page) {
                        echo "<option selected value='$cat_id'>{$cat_title}</option>";
                    } else {
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="sort_order">Sort Order</label>
            <input type="text" value ="<?php echo $sort_order?>" class="form-control" name="sort_order">
        </div> 
        <div class="form-group">
            <label for="prod_title">Title</label>
            <input type="text" value ="<?php echo $prod_title?>" class="form-control" name="prod_title">
        </div> 

        <div class="form-group">
            <label for="prod_image">Image</label>
            <img src="images/<?php echo $prod_image; ?>" width="100" alt="">
            <input type="file" name="prod_image">
        </div>

        <div class="form-group">
            <label for="blurb">Blurb</label>
            <textarea class="form-control" name="blurb" id="" cols="30" rows="5"><?php echo $blurb; ?>
            </textarea>
        </div>

        <div class="form-group">
            <select name="link_to" id="">  
                <option value='<?php echo $link_to ?>'><?php echo $link_to_page_title ?></option>
                <?php
                $query = "SELECT * FROM pagetable ORDER BY PageTableName ASC";  
                $select_categories = mysqli_query($connection, $query); 
                confirm($select_categories);

                while($row = mysqli_fetch_assoc($select_categories)){
                    $cat_id = $row['PageTableId'];
                    $cat_title = $row['PageTableName'];

                    if($cat_id == $link_to) {
                        echo "<option selected value='$cat_id'>{$cat_title}</option>";
                    } else {
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_product" value="Update Product">
        </div>
    </div>
</form>
       
<?php include "includes/footer.php"; ?>

</body>
