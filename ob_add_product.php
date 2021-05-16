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
    }
    
?>


<form action="" method="post" enctype="multipart/form-data">    
    <div class="container">
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
            <input type="text" class="form-control" name="sort_order">
        </div> 
        <div class="form-group">
            <label for="prod_title">Title</label>
            <input type="text" class="form-control" name="prod_title">
        </div> 

        <div class="form-group">
            <label for="prod_image">Image</label>
            <input type="file"  name="prod_image">
        </div>


        <div class="form-group">
            <label for="blurb">Blurb</label>
             <textarea class="form-control "name="blurb" id="" cols="30" rows="5"></textarea>
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
        </div>
    </div>
</form>
<?php include "includes/footer.php"; ?>
</body>
    
