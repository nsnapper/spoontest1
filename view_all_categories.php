
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

                
                echo "<td><a href='categories.php?source=edit_category&edit_category={$page_id}'>Edit</a></td>"; 
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this category?'); \" href='categories.php?delete={$page_id}'>Delete</a></td>"; 
                echo "</tr>";

            }


        ?>

      </tbody>

</table>


<?php

    if(isset($_GET['delete'])){

        $category_id = $_GET['delete'];
        $query = "DELETE FROM pagetable WHERE PageTableId = {$category_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");

}
       
 

?>

