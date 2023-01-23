<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'antoniano');
define('DB_PASSWORD', '1Y8P5aam$$8eNZ7DhB');
define('DB_NAME', 'Antoniano');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
