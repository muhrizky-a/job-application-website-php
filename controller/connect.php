<?php
$host = 'localhost';
$name = 'sistem_loker';
$username = 'root';
$password = '';

$connect = new mysqli($host,$username,$password,$name);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
