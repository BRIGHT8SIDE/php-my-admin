<?php

include('./DB/db.php');
$response = array();
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

$id = $_POST["id"];
$is_deleted = '0';

$result = $mysqli->query("UPDATE tbl_user_data SET is_deleted = '1' WHERE  user_id = '$id'");

if ($result) {
    $response['message'] = 'user block successfully.!';
    $response['status'] = 200;
} else {
    $response['message'] = 'Error block.!';
    $response['status'] = 500;
}

$mysqli->close();

echo json_encode($response);
