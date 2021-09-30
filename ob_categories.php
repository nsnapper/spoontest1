<?php include "app_variables.php"; ?>
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
    
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Page Name</th>
            <th>Page Blurb</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

    </thead>
    <tbody>
        <?php
        
            $query = "SELECT * FROM pagetable ORDER BY PageTableName ASC";  
            $select_categories = mysqli_query($connection, $query);             
            while($row = mysqli_fetch_assoc($select_categories)){
                $page_id =    escape($row['PageTableId']);
                $page_name =  escape($row['PageTableName']);
                $page_blurb = escape($row['PageTableBlurb']);
 
                echo "<tr>";
                echo "<td>$page_id</td>";
                echo "<td>$page_name</td>";
                echo "<td>$page_blurb</td>";
                
//                                echo "<td><a class='btn btn-info' href='products.php?source=edit_product&edit_product={$system_id}'>Edit</a></td>"; 

                
                echo "<td><a class='btn btn-info' href='ob_edit_category.php?edit_category={$page_id}'>Edit</a></td>"; 
                
                echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this category?'); \" href='ob_categories.php?delete={$page_id}'>Delete</a></td>"; 
                echo "</tr>";

            }


        ?>

      </tbody>

</table>
<?php include "includes/footer.php"; ?>

</body>


<?php

    if(isset($_GET['delete'])){

        $category_id = $_GET['delete'];
        $query = "DELETE FROM pagetable WHERE PageTableId = {$category_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: ob_categories.php");

}
       
 

?>

