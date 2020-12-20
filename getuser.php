<?php include('./DB/db.php');

$response = array();

$mysqli = new mysqli($servername, $username, $password, $dbname);

$user_id = $_REQUEST['id'];

$result = $mysqli->query("SELECT * FROM tbl_user_data where user_id = $user_id");

if ($result->num_rows > 0) {

    $response['data'] = $result->fetch_assoc();
    $response['status'] = '200';
    $response['message'] = 'data load success';
} else {
    $response['status'] = '200';
    $response['message'] = 'data load error';
}

$mysqli->close();
echo json_encode($response);
