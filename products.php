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
            <th>CategoryId</th>
            <th>Sort Order</th>
            <th>Title</th>
            <th>Image</th>
            <th>Blurb</th>
            <th>Link To</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>

    </thead>
    <tbody>
        <?php

            $query = "SELECT * FROM websitelayout ORDER BY ProdPageTableId, ProdPageSortOrder ASC";  
            $select_products = mysqli_query($connection, $query);             
            while($row = mysqli_fetch_assoc($select_products)){
                $system_id =    escape($row['System_ID']);
                $display_page = escape($row['ProdPageTableId']);
                $sort_order =   escape($row['ProdPageSortOrder']);
                $prod_title =   escape($row['ProdPageTitle']);
                $prod_image =   escape($row['ProdPageImage']);
                $blurb =        escape($row['ProdPageBlurb']);
                $link_to =      escape($row['ProdPageLinkTo']);
                

                $query = "SELECT * FROM pagetable WHERE PageTableId = $link_to";  
                $select_query = mysqli_query($connection, $query); 
                confirm($select_query);

                while($row = mysqli_fetch_assoc($select_query)){
                    $link_to_page_title = escape($row['PageTableName']);
                }
                $query = "SELECT * FROM pagetable WHERE PageTableId = $display_page";  
                $select_query = mysqli_query($connection, $query); 
                confirm($select_query);

                while($row = mysqli_fetch_assoc($select_query)){
                    $display_page_title = escape($row['PageTableName']);
                }
 
                echo "<tr>";
                echo "<td>$system_id</td>";
                echo "<td>$display_page_title</td>";
                echo "<td>$sort_order</td>";
                echo "<td>$prod_title</td>";
                
                echo "<td><img width='100' src='images/$prod_image' alt='images'></td>";

//                echo "<td>$prod_image</td>";
                echo "<td>$blurb</td>";
                echo "<td>$link_to_page_title</td>";
                
                echo "<td><a class='btn btn-info' href='edit_product.php?edit_product={$system_id}'>Edit</a></td>"; 
                
                echo "<td><a class='btn btn-danger' onClick=\"javascript: return confirm('Are you sure you want to delete this product?'); \" href='products.php?delete={$system_id}'>Delete</a></td>"; 

                echo "</tr>";

            }


        ?>

      </tbody>

</table>
    </body>
        <?php include "includes/footer.php"; ?>


<?php

    if(isset($_GET['delete'])){
        
        $system_id = $_GET['delete'];
        $query = "DELETE FROM websitelayout WHERE System_ID = {$system_id}";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: products.php");

}



?>

