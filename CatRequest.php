<!DOCTYPE html>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>

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

  </body>
    
</html>