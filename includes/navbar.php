<!DOCTYPE html>
<html lang="en">

<?php 
$CurrentPage = basename($_SERVER['PHP_SELF']);

//$AboutUsPage = 'AboutUs.php';
$ContactUsPage = 'ContactUs.php';
$FAQPage = 'FAQ.php';
$HomePage = 'index.php';
$CatRequestPage = 'CatRequest.php';

$AboutUsClass = '';
$ContactUsClass = '';
$FAQClass = '';
$HomeClass = '';
$ProductClass = '';
$CatRequestClass = '';
                              

if(isset($_GET['category'])){
//   && ($_GET['category'] == $category_id)){
    $ProductClass = 'active';
} else if ($CurrentPage == $HomePage) {
    $HomeClass = 'active';
//} else if ($CurrentPage == $AboutUsPage) {
//    $AboutUsClass = 'active';
} else if ($CurrentPage == $FAQPage) {
    $FAQClass = 'active';
} else if ($CurrentPage == $ContactUsPage) {
    $ContactUsClass = 'active';
} else if ($CurrentPage == $CatRequestPage) {
    $CatRequestClass = 'active';
}

?>
           
	  <nav class="navbar navbar-dark" _id="navbar" style="background-color: lightseagreen; border-radius: 0;">	

	  <a class="navbar-brand" href="#"></a>
	  <ul class="nav navbar-nav">
		<li class="nav-item">
		  <a class="nav-link <?php echo $HomeClass?>" href="index.php">Home</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link <?php echo $ProductClass?>" href='prod_page.php?category=1'>Products</a>
		</li>
<!--
		<li class="nav-item">
		  <a class="nav-link <?php echo $AboutUsClass?>" href="AboutUs.php">About Us</a>
		</li>
-->
		<li class="nav-item">
		  <a class="nav-link <?php echo $FAQClass?>" href="FAQ.php">FAQ</a>
		</li>
        <li class="nav-item">
		  <a class="nav-link <?php echo $ContactUsClass?>" href="ContactUs.php">Contact Us</a>
		</li>
        <li class="nav-item">
		  <a class="nav-link <?php echo $CatRequestClass?>" href="CatRequest.php">Catalog Request</a>
		</li>
        <li class="nav-item">
		  <a class="nav-link" href="http://spoontiques.cameoez.com/Scripts/PublicSite/?template=Login">Retailer Login</a>
		</li>
     </ul>


	</nav>



         
 