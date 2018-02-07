<!DOCTYPE html>

<html lang="en">
    
  <head>
      
    <title>Spoontiques, Inc. - Wholesale Giftware</title>
      
 
      
    <meta charset="utf-8">
      
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/3d8abb5100.js"></script>
      
    <script type="text/javascript" src="jquery.min.js"></script>
        
    <script src="jquery-ui/jquery-ui.js"></script>
        
    <link href="jquery-ui/jquery-ui.css" rel="stylesheet">	
        <link rel="stylesheet" type="text/css" href="css/Spoontiques.css">

    <script src='https://www.google.com/recaptcha/api.js'></script>
 </head>
    
 
 <body>
     
    <?php include "includes/logo.php"; ?>
    <?php include "includes/navbar.php"; ?>  
         
          
        <div id="Note">
        
         <h5>Please note: We sell only to approved retailers with a valid resale certificate.</h5>

         </div>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Catalog Request</h1>
                    <form role="form" action="CatRequest.php" method="post" id="cat-request-form" autocomplete="off">
                       <h4 class="text-center">* indicates a required field</h4>

                       <div class="form-group">
                            <input type="text" name="storeName" id="storeName" class="form-control" placeholder="* Store Name" required>
                        </div>
                       <div class="form-group">
                            <input type="text" name="firstName" id="firstName" class="form-control" placeholder="* First Name" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="lastName" id="lastName" class="form-control" placeholder="* Last Name" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="address1" id="address1" class="form-control" placeholder="* Address Line 1" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="address2" id="address2" class="form-control" placeholder="Address Line 2" >
                        </div>
                         <div class="form-group">
                            <input type="text" name="city" id="city" class="form-control" placeholder="* City" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="state" id="state" class="form-control" placeholder="* State or Provence" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="zip" id="zip" class="form-control" placeholder="* Zip or Postal Code" required>
                        </div>
                         <div class="form-group">
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="* Phone" required>
                        </div>
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="* Email Address" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="taxId" id="taxId" class="form-control" placeholder="* Tax ID #" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="products" id="products" class="form-control" placeholder="What products are you interested in?" >
                        </div>
                        <div class="form-group">
                            <input type="text" name="businessType" id="businessType" class="form-control" placeholder="What type of business do you have?">
                        </div>
                        <div class="form-group">
                            <input type="text" name="businessURL" id="businessURL" class="form-control" placeholder="Business Website">
                        </div>                        
                        <div class="g-recaptcha" data-sitekey="6Ldx5UQUAAAAAF6YYFpwAWSCkvs4Pj5cBz3lrKjk"></div>
                        <input type="submit" name="submit" id="btn-submit" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->

		
    </div> <!-- /.container -->
</section>
          

<?php include "includes/footer.php"; ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-
	alpha.2/js/bootstrap.min.js" integrity="sha384-
	vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" 
	crossorigin="anonymous"></script>
	
	<script type="text/javascript">

	</script>
  </body>
    
</html>