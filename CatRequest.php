<!DOCTYPE html>

<html lang="en">

<head>
    <?php include "includes/common_head.php"; ?>

</head>
    
 
 <body>
    <?php include "db.php"; ?>       
    <?php include "includes/logo.php"; ?>
    <?php include "includes/navbar.php"; ?>
    <?php require './vendor/autoload.php'; ?>
    <?php require './classes/Config.php'; ?>
    <?php use PHPMailer\PHPMailer\PHPMailer; ?>  
        
<?php

$message = "";
    if(isset($_POST['submit'])){
        $to             = "nancy@snapper.net";
        $storeName      = $_POST['storeName'];
        $firstName      = $_POST['firstName'];
        $lastName       = $_POST['lastName'];
        $address1       = $_POST['address1'];
        $address2       = $_POST['address2'];
        $city           = $_POST['city'];
        $state          = $_POST['state'];
        $zip            = $_POST['zip'];
        $phone          = $_POST['phone'];
        $email          = $_POST['email'];
        $taxId          = $_POST['taxId'];
        $products       = $_POST['products'];
        $businessType   = $_POST['businessType'];
        $businessURL    = $_POST['businessURL'];
        $localRep       = $_POST['localRep'];
        
        $storeName      = mysqli_real_escape_string($connection, $storeName);
        $firstName      = mysqli_real_escape_string($connection, $firstName);
        $lastName       = mysqli_real_escape_string($connection, $lastName);
        $address1       = mysqli_real_escape_string($connection, $address1);
        $address2       = mysqli_real_escape_string($connection, $address2);
        $city           = mysqli_real_escape_string($connection, $city);
        $state          = mysqli_real_escape_string($connection, $state);
        $zip            = mysqli_real_escape_string($connection, $zip);
        $phone          = mysqli_real_escape_string($connection, $phone);
        $email          = mysqli_real_escape_string($connection, $email);
        $taxId          = mysqli_real_escape_string($connection, $taxId);
        $products       = mysqli_real_escape_string($connection, $products);
        $businessType   = mysqli_real_escape_string($connection, $businessType);
        $businessURL    = mysqli_real_escape_string($connection, $businessURL);
        $localRep       = mysqli_real_escape_string($connection, $localRep);
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = Config::SMTP_HOST;
        $mail->Username = Config::SMTP_USER;
        $mail->Password = Config::SMTP_PASSWORD;
        $mail->Port = Config::SMTP_PORT;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('service@spoontiques.com', 'Spoontiques Customer Service');
        $mail->addAddress($to);

        $mail->Subject = "Web Catalog Request";
        
        $body = "<p>Store Name: " . $storeName . "</p>";
        $body .= "<p>Name: " . $firstName . " " . $lastName . "</p>";   
        $body .= "<p>Address 1: " . $address1 . "</p>";
        $body .= "<p>Address 2: " . $address2 . "</p>";
        $body .= "<p>City State Zip: " . $city . ", " . $state . "  " . $zip . "</p>";
        $body .= "<p>Phone: " . $phone . "</p>";
        $body .= "<p>email: " . $email . "</p>";
        $body .= "<p>taxId: " . $taxId . "</p>";
        $body .= "<p>interest: " . $products . "</p>";
        $body .= "<p>business type: " . $businessType . "</p>";
        $body .= "<p>business URL: " . $businessURL . "</p>";
        $body .= "<p>Have local rep contact me: " . $localRep . "</p>";

        $mail->Body = $body;
        if($mail->send()){

            $emailSent = true;
            header("Location:" . "success.php");

        } else {

            echo "Error occured.  Your message was not sent.";

        }

    }
?>
         
          
        <div id="Note">
        
         <p class="pageNote">Please note: We sell only to approved retailers with a valid resale certificate.</p>

         </div>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <p class="subtitle">Catalog Request</p>
                    <form role="form" action="CatRequest.php" method="post" id="cat-request-form" autocomplete="off">
                       <p>* indicates a required field</p>

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
                        <div class="form-group">
                            <input type="text" name="localRep" id="localRep" class="form-control" placeholder="Would you like your local rep to contact you?">
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