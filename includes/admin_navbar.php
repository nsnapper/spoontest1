<!DOCTYPE html>
<html lang="en">

<?php 
$CurrentPage = basename($_SERVER['PHP_SELF']);

$HomePage = 'index.php';
$CategoriesPage = 'ob_categories.php';
$ProductsPage = 'ob_products.php';
$AddCatPage = 'ob_add_category.php';
$AddProductPage = 'ob_add_product.php';

$HomeClass = '';
$CategoriesClass = '';
$ProductsClass = '';
$AddCatClass = '';
$AddProductClass = '';
                              

if(isset($_GET['category'])){
//   && ($_GET['category'] == $category_id)){
    $ProductClass = 'active';
} else if ($CurrentPage == $HomePage) {
    $HomeClass = 'active';
} else if ($CurrentPage == $CategoriesPage) {
    $CategoriesClass = 'active';
} else if ($CurrentPage == $AddCatPage) {
    $AddCatClass = 'active';
} else if ($CurrentPage == $ProductsPage) {
    $ProductsClass = 'active';
} else if ($CurrentPage == $AddProductPage) {
    $AddProductClass = 'active';
}

?>
           
	  <nav class="navbar navbar-dark" _id="navbar" style="background-color: lightseagreen; border-radius: 0;">	

	  <a class="navbar-brand" href="#"></a>
	  <ul class="nav navbar-nav">
		<li class="nav-item">
		  <a class="nav-link <?php echo $HomeClass?>" href="index.php">Home</a>
		</li>

		<li class="nav-item">
		  <a class="nav-link <?php echo $CategoriesClass?>" href="ob_categories.php">Categories</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php echo $AddCatClass?>" href="ob_add_category.php">Add Categories</a>
		</li>
        <li class="nav-item">
		  <a class="nav-link <?php echo $ProductsClass?>" href="ob_products.php">Products</a>
		</li>
        <li class="nav-item">
		  <a class="nav-link <?php echo $AddProductClass?>" href="ob_add_product.php">Add Products</a>
		</li>
     </ul>


	</nav>



         
 