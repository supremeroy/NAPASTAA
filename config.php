<?php

$conn = mysqli_connect('localhost','root','','napastaa_db');
if (!$conn) {
    echo " did not connect";
}
$mysqli = new mysqli('localhost', 'root', '', 'napastaa_db');

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>