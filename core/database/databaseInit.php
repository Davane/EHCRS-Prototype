<?php

defined('APP_RAN') or header('Location: https://172.20.10.2/~davanedavis/EHCRS-Prototype/unauthorized_access.php');

# Author: Davane Davis
# Date January 20, 2017

/*error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");*/

define('hostname', 'localhost');
define('user','root');
define('password', 'Root_123456');
define('database', 'health_care_mp');

// creating connection
$connect = mysqli_connect(hostname, user, password, database);

// Check connection
if (!$connect) {
    die("Connection failed: " . $connect->connect_error);
} else {
    #echo 'connect';
}


function closeConnection(){
    $connect->close();
}

?>
