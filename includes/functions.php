<?php
function redirectIfAvailable($redirectKey)
{
    include "config.php";
    $conn = new mysqli($db_host, $db_user, $db_pw, $db_db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM shorturl.links WHERE url_key = '$redirectKey'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $conn->close();
    if ($row == null) {
        header("Location: http://" . $_SERVER['HTTP_HOST']);
    } else {
        $redirectTo = $row[1];
        header("Location: " . $redirectTo);
    }
    die();

}

function addUrlToDB()
{
    include "config.php";
    $conn = new mysqli($db_host, $db_user, $db_pw, $db_db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $long_url = mysqli_escape_string($conn, $_POST['long']);
    $short_string = mysqli_escape_string($conn, $_POST['short']);
    $ip = $_SERVER['REMOTE_ADDR'];

    $query = "INSERT INTO shorturl.links(url_key, long_url, added_by_ip, added_at_date) VALUES ('$long_url','$short_string','$ip',now())";
    if ($conn->query($query) === TRUE) {
        echo json_encode(array("gud" => "yes"));
    }
    $conn->close();
}

function hcaptchaCheck()
{
    include "config.php";
    $data = array(
        'secret' => $hcaptcha_secret,
        'response' => $_POST['h-captcha-response']
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $responseData = json_decode($response);
    if ($responseData->success) {
        return json_decode($response, true);
    } else {
        return json_decode($response, true);
    }
}