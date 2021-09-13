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
    if ($row == null) {
        header("Location: http://" . $_SERVER['HTTP_HOST']);
    } else {
        $redirectTo = $row[1];
        $conn->query("UPDATE shorturl.links SET hits=hits+1 WHERE url_key='$redirectKey'");
        header("Location: " . $redirectTo);
    }
    $conn->close();
    die();

}

function hcaptchaCheck($res)
{
    include "config.php";
    $data = array(
        'secret' => $hcaptcha_secret,
        'response' => $res
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    return json_decode($response, true);
}

function inputCheck($short, $long)
{
    $sqlCheck = true;
    $row = null;
    if ($short == "") {
        $short = generateRandomLetters(6);
        $sqlCheck = false;
    }
    if (preg_match("/^[a-zA-Z0-9]*$/", $short)) {

        if ($long != "") {

            if (filter_var($long, FILTER_VALIDATE_URL)) {

                if ($sqlCheck) {
                    include "config.php";
                    $conn = new mysqli($db_host, $db_user, $db_pw, $db_db);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $query = "SELECT * FROM shorturl.links WHERE url_key = '$short'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_row($result);
                    $conn->close();
                }
                if ($row == null) {
                    return array(true, $short);
                }
            }
        }
    }
    return array(false, "");
}

function generateRandomLetters($len)
{
    include "config.php";
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $conn = new mysqli($db_host, $db_user, $db_pw, $db_db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT url_key FROM shorturl.links";
    $result = mysqli_query($conn, $query);
    $keysTaken = mysqli_fetch_array($result);
    $conn->close();
    do {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $len; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
    } while (in_array($randomString, $keysTaken));
    return $randomString;
}