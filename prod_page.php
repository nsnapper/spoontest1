<!DOCTYPE html>
<?php include "app_variables.php"; ?>
<?php include "db.php"; ?>


<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>

 
 <body>
     
    
<?php include "includes/logo.php"; ?>
   
<?php include "includes/navbar.php"; ?>

         
   <?php

    if(isset($_GET['category'])){
        $category_id = $_GET['category'];
    }

    $query = "SELECT * FROM pagetable WHERE PageTableId = $category_id";
    $select_category_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($select_category_query);

    if($count > 0) {
        while($row = mysqli_fetch_assoc($select_category_query)){
            $category_title = $row['PageTableName'];
            $category_blurb = $row['PageTableBlurb'];

        }
        echo "<div id='Products'>";
            echo "<p class='subtitle'>$category_title</p>";
         echo "</div>";

    }
 
    ?>

                    
	   <div class="container">
        <div class="card-deck-wrapper">
            <div class="card-deck">
 
	
<?php
    $count = 0;
    $query = "SELECT * FROM websitelayout WHERE ProdPageTableId = $category_id ORDER BY ProdPageSortOrder";  
    $select_layout = mysqli_query($connection, $query);             
    while($row = mysqli_fetch_assoc($select_layout)){
        $page_title = $row['ProdPageTitle'];
        $image_file = $row['ProdPageImage'];
        $blurb = $row['ProdPageBlurb'];
        $next = $row['ProdPageLinkTo'];

        $next_page = "";
        $next_query = "SELECT * FROM pagetable WHERE PageTableId = $next";  
        $select_next = mysqli_query($connection, $next_query);             
//        $row = mysqli_fetch_assoc($select_next);
        if (!$select_next) {
            $next_page = "";
        } else {
            $row = mysqli_fetch_assoc($select_next);
            $next_page = $row['PageTableName'];
        
        }
        $count += 1;
        if($count > 3){
            $count = 1;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="subtitle">';
            echo '<div class="row">';
            echo '</div>';
	        echo '</div>';
            echo '<div class="container">';
            echo '<div class="card-deck-wrapper">';
            echo '<div class="card-deck">';

        }
        
        echo '<div class="card" style="width: 20rem;">';
        echo "<img class='card-img-top' src='$cms_images/$image_file' alt=$image_file img width=300 img height=300>";      
        if ($next_page !== "none"){
            echo "<div class='card-block-product card-block'>
            <a href='prod_page.php?category=$next''><p class='card-title'> $page_title</p></a>";

        } else {

            echo "<div class='card-block-product card-block'> 
            <h4 class='card-title'> $page_title</h4>";
        }
        echo "<p class='card-text'>$blurb</p>";
        echo "</div>";
        echo '</div>';

        
        
    }
if($count < 3){
    $image_file = "sections.jpg";
    if($count == 1) {
        echo '<div class="card" style="width: 20rem;">';
//        echo "<img class='card-img-top' src='$cms_images/$image_file' alt=$image_file img width=300 img height=300>";    
//        echo "<div class='card-block'>";
//        echo "<p class='card-text'></p>";
//        echo "</div>";
        echo '</div>';
    }
    echo '<div class="card" style="width: 20rem;">';
//    echo "<img class='card-img-top' src='$cms_images/$image_file' alt=$image_file img width=300 img height=300>";    
//    echo "<div class='card-block'>";
//    echo "<p class='card-text'></p>";
//    echo "</div>";
    echo '</div>';
    
}    
    
?>
</div>
        </div>
    </div>
	
<?php include "includes/bottom_note.php"; ?>
         
<?php include "includes/footer.php"; ?>
		
  </body>
    
</html>