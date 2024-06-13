<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "baza";

$dbc = mysqli_connect($server, $user, $pass, $db) or die('Error connecting to MySQL server: ' . mysqli_connect_error());

?>