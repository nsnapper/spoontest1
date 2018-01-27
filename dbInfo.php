<?php

//mysql://b7a7e5ee9c955a:8c71d871@us-cdbr-iron-east-05.cleardb.net/heroku_aeeec5f573ac96d?reconnect=true
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
//
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

?>
<!DOCTYPE html>
<?php include "db.php"; ?>
<!--<?php include "includes/header.php";  ?>-->

<html lang="en">
    
  <head>
  </head>
  <body>
  <h3>U: <?= $username ?></h3>
  <h3>P: <?= $password ?></h3>
  <h3>S: <?= $server ?></h3>
  <h3>DB: <?= $db ?></h3>
  </body>
  
 </html>