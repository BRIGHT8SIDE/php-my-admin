<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_db";

$connection = mysqli_connect($servername,$username,$password,$dbname);


if(mysqli_connect_errno()){
    die("mysqli connection error" . mysqli_connect_errno());
}else{
    // echo "connection success mchan" ;
}




?>