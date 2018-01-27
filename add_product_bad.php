<?php
    

    if(isset($_POST['add_product'])){
        $display_page       = $_POST['display_page'];
        $sort_order        = $_POST['sort_order'];
        $prod_title        = ($_POST['prod_title']);
        $prod_image        = ($_FILES['prod_image']['name']);
        $prod_image_temp   = ($_FILES['prod_image']['tmp_name']);
        $blurb             = ($_POST['blurb']);
        $link_to           = ($_POST['link_to']);
        move_uploaded_file($prod_image_temp,"images/$prod_image");
        
        
        $query = "INSERT INTO websitelayout(ProdPageTableId, ProdPageSortOrder, ProdPageTitle, ProdPageImage, ProdPageBlurb, ProdPageLinkTo)";
        
        $query .="VALUES('{$display_page}', '{$sort_order}','{$prod_title}', '{$prod_image}','{$blurb}','{$link_to}')";
        

        $add_product_query = mysqli_query($connection, $query);

        confirm($add_product_query);
    }
    
?>

          <?php echo "this is where form should go"; ?>
<form action="" method="post" enctype="multipart/form-data">
          <?php echo "in form"; ?>
          
              <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="text" class="form-control" name="sort_order">
    </div> 
    <div class="form-group">
        <label for="prod_title">Title</label>
        <input type="text" class="form-control" name="prod_title">
    </div> 

          
             <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_product" value="Add Product">
    </div>


</form>  

<!--
<form action="" method="post" enctype="multipart/form-data">    



    <div class="form-group">
       <?php echo "I am in page again in select cats"; ?>

        <select name="display_page" id="">
          <?php echo "I am in page again in select cats2"; ?>
        
            <?php
  echo "I am in page again before select cats"; 
               $query = "SELECT * FROM pagetable";  
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

<?php echo "I am in page again after select cats"; ?>


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
         <textarea class="form-control "name="blurb" id="" cols="30" rows="5">
         </textarea>
     </div>
    
        <div class="form-group">
        <select name="link_to" id="">
            <?php
                $query = "SELECT * FROM pagetable";  
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

</form>
-->
