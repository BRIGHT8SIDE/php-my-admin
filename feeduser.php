<?php

include('./DB/db.php');
$response = array();
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}


$result = $mysqli->query("SELECT * FROM tbl_user_data WHERE is_deleted = '0' ");
if ($result->num_rows > 0) {
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $response['data'][$count] =  $row;
        $count++;
    }
}

$mysqli->close();

echo json_encode($response);
