<!DOCTYPE html>
<?php include "db.php"; ?>
<!--<?php include "includes/header.php";  ?>-->

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>
</head>
    
 
 <body>
     
    <?php include "includes/logo.php"; ?>
    <?php include "includes/navbar.php"; ?>
    
      <div id="banner" class="banner">
          <img src="images/FullBanner.jpg" alt="product banner" img width = 100%>;
      </div>  

<!--
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img src="images/LifestyleW1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img src="images/LifestyleW2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img src="images/LifestyleW3.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img src="images/LifestyleW4.jpg" alt="Fourth slide">
            </div>
        </div>
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="icon-prev" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="icon-next" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
-->
         
   	<div class="subtitle" id="Products">
		<div class="row">
			<h1>Products</h1>
        </div>
	</div>
    <div class="container">
        <div class="card-deck-wrapper">
            <div class="card-deck">
 
	
<?php
    $count = 0;
    $query = "SELECT * FROM websitelayout WHERE ProdPageTableId = 1 ORDER BY ProdPageSortOrder";  
    $select_layout = mysqli_query($connection, $query);             
    while($row = mysqli_fetch_assoc($select_layout)){
        $page_title = $row['ProdPageTitle'];
        $image_file = $row['ProdPageImage'];
        $blurb = $row['ProdPageBlurb'];
        $next = $row['ProdPageLinkTo'];

        $next_page = "";
        $next_query = "SELECT * FROM pagetable WHERE PageTableId = $next";  
        $select_next = mysqli_query($connection, $next_query);             
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
//            echo '<div class="subtitle" id="Products">';
//            echo '<div class="row">';
//            echo '</div>';
//	        echo '</div>';
            echo '<div class="container">';
            echo '<div class="card-deck-wrapper">';
            echo '<div class="card-deck">';

        }
        
//                echo "<td><a href='categories.php?source=edit_category&edit_category={$page_id}'>Edit</a></td>"; 
        
        echo '<div class="card" style="width: 20rem;">';
                 echo "<img class='card-img-top' src='images/$image_file' alt=$image_file img width=350 img height=350>";      
        if ($next_page !== "none"){
            echo "<div class='card-block-product card-block'>
            <a href='prod_page.php?category=$next''><h4 class='card-title'> $page_title</h4></a>";

        } else {

            echo "<div class='card-block-product card-block'>
            <h4 class='card-title'> $page_title</h4>";
        }
        echo "<p class='card-text'>$blurb</p>";
        echo "</div>";
        echo '</div>';

        
        
//        echo "<tr>";
//        echo "<td>{$image_file}</td>";
//        echo "<td><img width='100' src='images/$image_file' alt='images'></td>";

    }
if($count < 3){
    if($count == 1) {
    echo '<div class="card" style="width: 20rem;">';
//        echo "<div class='card-block'>";
//        echo "<p class='card-text'></p>";
//        echo "</div>";
        echo '</div>';
    }
    echo '<div class="card" style="width: 20rem;">';
//    echo "<div class='card-block'>";
//    echo "<p class='card-text'></p>";
//    echo "</div>";
    echo '</div>';
    
}    
?>
</div></div></div>
	
          
<?php include "includes/footer.php"; ?>
		

  </body>
    
</html>
