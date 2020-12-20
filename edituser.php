<?php require_once('./DB/db.php');

$response = array();

if (isset($_POST['submit'])) {

    $user_id = $_POST['txt_order_id'];
    $full_name = $_POST['txt_fullname'];
    $user_Address = $_POST['txt_address'];
    $user_mobile = $_POST['txt_mobile'];
    $user_email = $_POST['txt_email'];

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    //password convert to sha 256 and trim data
    $user_email = mysqli_real_escape_string($connection, $_POST['txt_email']);
    $user_password = mysqli_real_escape_string($connection, $_POST['txt_password']);
    $hashed_password = hash('sha256', $user_password);

    $result = $mysqli->query("UPDATE tbl_user_data SET full_name = '$full_name',user_Address = '$user_Address', user_mobile = '$user_mobile', user_email = '$user_email'  WHERE  user_id = '$user_id'");

    // echo $result;
    // die();

    if ($result) {
        $response['message'] = 'User Record Save Success.!';
        $response['status'] = 200;
    } else {
        $response['message'] = 'User Record Cannot Save.!';
        $response['status'] = 500;
    }


    $mysqli->close();

    echo json_encode($response);
}
