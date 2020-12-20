<?php require_once('./DB/db.php');

$response = array();

if (isset($_POST['submit'])) {

    $full_name = $_POST['txt_fullname'];
    $user_Address = $_POST['txt_address'];
    $user_mobile = $_POST['txt_mobile'];
    $user_email = $_POST['txt_email'];
    $user_password = $_POST['txt_password'];
    $active_Status = '1';
    $is_deleted = '0';

    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    }

    $res = $mysqli->query("SELECT *  FROM tbl_user_data WHERE user_email='" . $user_email . "'");
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $response['message'] = 'OOPS Email is already exsist in the system.. Please Check!';
        $response['status'] = 500;
    }
    $res = $mysqli->query("SELECT *  FROM tbl_user_data WHERE user_mobile='" . $user_mobile . "'");
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $response['message'] = 'OOPS mobile number is already exsist in the system.. Please Check!';
        $response['status'] = 500;
    } else {

        //password convert to sha 256 and trim data
        $user_email = mysqli_real_escape_string($connection, $_POST['txt_email']);
        $user_password = mysqli_real_escape_string($connection, $_POST['txt_password']);
        $hashed_password = hash('sha256', $user_password);

        $result = $mysqli->query("INSERT INTO tbl_user_data(full_name, user_Address, user_mobile,user_email,user_password,active_Status,is_deleted)
    VALUES ('" . $_POST['txt_fullname'] . "', '" . $_POST['txt_address'] . "', '" . $_POST['txt_mobile'] . "', '" . $_POST['txt_email'] . "', '$hashed_password','1','0')");

        // echo $result;
        // die();

        if ($result) {
            $response['message'] = 'User Record Save Success.!';
            $response['status'] = 200;
        } else {
            $response['message'] = 'User Record Cannot Save.!';
            $response['status'] = 500;
        }
    }

    $mysqli->close();

    echo json_encode($response);
}
