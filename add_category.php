 
<?php
    

    if(isset($_POST['add_category'])){
        $page_name         = escape($_POST['page_name']);
        $page_blurb        = escape($_POST['page_blurb']);     
        
        $query = "INSERT INTO pagetable(PageTableName, PageTableBlurb)";
        
        $query .="VALUES('{$page_name}', '{$page_blurb}')";       

        $add_category_query = mysqli_query($connection, $query);

        confirm($add_category_query);
    }
    
?>

<form action="" method="post" enctype="multipart/form-data">    


    <div class="form-group">
        <label for="page_name">Page Name</label>
        <input type="text" class="form-control" name="page_name">
    </div> 
    
    <div class="form-group">
        <label for="page_blurb">Blurb</label>
        <input type="text" class="form-control" name="page_blurb">
    </div> 

    <div class="form-group">
    <input class="btn btn-primary" type="submit" name="add_category" value="Add Category">
    </div>

</form>
