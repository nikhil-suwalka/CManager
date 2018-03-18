<?php
//Connect to Database

$db_host = 'localhost';
$db_name = 'usera';
$db_user = 'nikhil';
$db_pass = 'nsuwalka';

//Create mysqli Object
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);


//Error Handler
if (mysqli_connect_errno()){
    echo "This connection Failed".mysqli_connect_error();
    die();
}