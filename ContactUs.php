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

 </head>
    
 
 <body>
     
    <?php include "includes/logo.php"; ?>
    <?php include "includes/navbar.php"; ?>  
 
<?php


    if(isset($_POST['submit'])){
        $to       = "nancy@snapper.net";
        $email    = $_POST['email'];
        $subject  = $_POST['subject'];
        $body     = $_POST['body'];
        
        if (!empty($subject) && !empty($email) && !empty($body)){
//            $subject    = mysqli_real_escape_string($connection, $subject);
//            $email      = mysqli_real_escape_string($connection, $email);
//            $body       = mysqli_real_escape_string($connection, $body);

//            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
//
//            $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
//            $query .= "VALUES ('{$username}','{$email}','{$password}', 'Subscriber' )";
//            $register_user_query = mysqli_query($connection, $query);
//            if(!$register_user_query) {
//                die("QUERY FAILED ". mysqli_error($connection) . ' ' . mysqli_errno($connection));
//            }
            
            $body = wordwrap($body,70);
            mail($to,$subject,$body);
            $message = "Your info has been submitted";
            
        } else {
            $message = "Fields cannot be empty";
        }
    } else {
        $message = "";
    }
?>

 
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
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
                        
                        
                            <tr>
                              <td width="48%" align="right">&nbsp;                              </td>
                              <td width="4%" align="center">&nbsp;</td>
                              <td width="48%" align="left">
                                <img src="includes/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>                              </td>
                            </tr>
                            <tr>
                              <td width="48%" align="right">
                                <label for='message'>Enter the image code above here</label>                              </td>
                              <td width="4%" align="center">:</td>
                              <td width="48%" align="left">
                                <input id="6_letters_code" name="6_letters_code" type="text">                              </td>
                            </tr>
                            <tr>
                              <td colspan=3 _width="48%" align="center">
                                <small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>                              </td>
                            </tr>
                        
                        <input type="submit" name="submit" id="btn-submit" class="btn btn-custom btn-lg btn-block" value="Submit">                
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


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
