<?php 

$host = "localhost";         // because XAMPP runs the server locally
$user = "root";          // default username for XAMPP's MySQL
$pwd = "";              // default password is empty in XAMPP
$sql_db = "project2";  // replace with the actual name of your database

$connect = new mysqli($host, $user, $pwd, $sql_db); //connect to proj2 db

if ($connect->connect_error) {
    die("Database connection failed."); //error msg if fail

}

?>