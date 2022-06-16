<?php
 session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'manage_product');
define('SITE_URL','http://localhost/code/Admin_PHP/');
// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error($conn));// select DB.
//Check the connection
if($conn == false){
    echo('Error: Cannot connect');
}



?>
