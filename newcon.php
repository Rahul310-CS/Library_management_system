<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'library.sql';

$link = mysqli_connect($host, $user, $password, $database);

if (!$link) {
    die('Could not connect: ' . mysqli_connect_error());
}

echo 'Connected successfully';

?>
