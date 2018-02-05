
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
                
                if (mysqli_num_rows($select_query) > 0) {
                     while($row = mysqli_fetch_assoc($select_query)){
                        $link_to_page_title = escape($row['PageTableName']);
                    }                   
                }
                else {
                    $link_to_page_title = "unknown";
                }

                while($row = mysqli_fetch_assoc($select_query)){
                    $link_to_page_title = escape($row['PageTableName']);
                }
                $query = "SELECT * FROM pagetable WHERE PageTableId = $display_page";  
                $select_query = mysqli_query($connection, $query); 
                confirm($select_query);
                
                if (mysqli_num_rows($select_query) > 0) {                
                    while($row = mysqli_fetch_assoc($select_query)){
                        $display_page_title = escape($row['PageTableName']);
                    }
                }
                else {
                    $display_page_title = "unknown";
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
                
                echo "<td><a href='products.php?source=edit_product&edit_product={$system_id}'>Edit</a></td>"; 
                
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this product?'); \" href='products.php?delete={$system_id}'>Delete</a></td>"; 
                
                echo "</tr>";


                echo "</tr>";

            }


        ?>

      </tbody>

</table>


<?php

    if(isset($_GET['delete'])){
        $system_id = $_GET['delete'];
        echo "nms in delete" . $system_id;

        $query = "DELETE FROM websitelayout WHERE System_ID = {$system_id}";
        echo "nms query: " . $query;
        
        $delete_query = mysqli_query($connection, $query);

    
    if (!$delete_query) {

        die("QUERY FAILED" . mysqli_error($connection));
    }
    

}
//        header("Location: products.php");



?>

