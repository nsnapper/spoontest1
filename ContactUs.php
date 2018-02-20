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
//        $to       = "nancy@snapper.net";
        $email    = $_POST['email'];
        $subject  = $_POST['subject'];
        $body     = $_POST['body'];
//        
//        if (!empty($subject) && !empty($email) && !empty($body)){
            $subject    = mysqli_real_escape_string($connection, $subject);
            $email      = mysqli_real_escape_string($connection, $email);
            $body       = mysqli_real_escape_string($connection, $body);
//
//            
            $body = wordwrap($body,70);
//            mail($to,$subject,$body);
            $message = "Your info has been submitted";
//            
//        } else {
//            $message = "Fields cannot be empty";
//        }
//    } else {
//        $message = "";
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
                    $mail->addAddress($email);

                    $mail->Subject = "Web Contact Us: " . $subject;
                    
                    $mail->Body = "From: " . $email . " " . '<p>' . $body . '</p>';
                    if($mail->send()){

                        $emailSent = true;
                        header("Location:" . "success.php");

                    } else{

                        echo "Error occured.  Your message was not sent.";

                    }

    }
?>

 
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <p class="subtitle">Contact Us</p>
                    <form role="form" action="ContactUs.php" method="post" id="contact-form" autocomplete="off">
                       <h4 class="text-center"><?php echo $message; ?></h4>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">username</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <label class="sr-only">Question/Comment</label>
                            <textarea class="form-control" name="body" id="body" placeholder="Enter question/comment"></textarea>
                        </div>
                        
                        
                        <div class="g-recaptcha" data-sitekey="6Ldx5UQUAAAAAF6YYFpwAWSCkvs4Pj5cBz3lrKjk"></div>
                        <input type="submit" name="submit" id="btn-submit" class="btn btn-custom btn-lg btn-block" value="Submit">                
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


<?php include "includes/footer.php"; ?>


  </body>
    
</html>
