<?php
include "config.php";
include "functions.php";
if (isset($_POST['long']) and isset($_POST['short'])) {

    $long = $_POST["long"];
    $long = !str_starts_with($long, 'http') ? "http://$long" : $long;

    $checkRes = inputCheck($_POST['short'], $long);
    if ($checkRes[0]) {

//        $res = hcaptchaCheck($_POST['captcha']);
//        if (!$res['success']) {
//            echo json_encode(array("status" => "captcha-failure"));
//            die();
//        }
        $conn = new mysqli($db_host, $db_user, $db_pw, $db_db);
        if ($conn->connect_error) {
            echo json_encode(array("status" => "sql-connect-failure"));
            die();
        }
        $long_url = mysqli_escape_string($conn, $long);
        $short_string = mysqli_escape_string($conn, $checkRes[1]);
        $ip = $_SERVER['REMOTE_ADDR'];

        $query = "INSERT INTO shorturl.links(url_key,long_url, added_by_ip, added_at_date) VALUES ('$short_string','$long_url','$ip',now())";
        if ($conn->query($query) === TRUE) {
            echo json_encode(array("status" => "success", "shortLink" => "https://s.reisminer.xyz/".$short_string));
        } else {
            echo json_encode(array("status" => "sql-failure"));
        }
        $conn->close();
    } else {
        echo json_encode(array("status" => "input-wrong"));
    }
} else {
    echo json_encode(array("status" => "input-not-there"));
}
die();