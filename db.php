<?php

//mysql://b7a7e5ee9c955a:8c71d871@us-cdbr-iron-east-05.cleardb.net/heroku_aeeec5f573ac96d?reconnect=true
// Just a comment
if (getenv("CLEARDB_DATABASE_URL") != null) {
    $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    //
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"], 1);
    $connection = new mysqli($server, $username, $password, $db);
} else {

// LOCALHOST settings:
    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "root";
    $db['db_name'] = "spoontiqueswebsite";
    $connection = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_name']);
}
//foreach($db as $key => $value){
    
//    define(strtoupper($key), $value);
    
    
//}

//$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//if($connection) {
//    
//    echo "We are connected again";
//    
//} else {
//    
//      echo "we are not connected";
//  
//} 


?>
