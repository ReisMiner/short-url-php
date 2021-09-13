<?php
include "includes/functions.php";

if (isset($_POST['long']) and isset($_POST['short'])) {
    //when url is submitted

}else{
    //when site is loaded normally
    $slash = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (strlen($slash)>0)
        redirectIfAvailable($slash);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReisMiner - URL Shortener</title>
    <script src="assets/main.js"></script>
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
<h1>ReisMiner Short URL Service</h1>
<h2>Create Shorturls for Free</h2>
<form method="post" action="create/" id="urlForm">
    <input name="long" id="long" type="text" placeholder="Long URL">
    <input name="short" id="short" type="text" placeholder="Short string (optional)">
    <span class="h-captcha" data-sitekey="af47fc96-46be-45e9-b7c3-bfcc9f14a85e" data-theme="dark"></span>
</form>
<a id="submitURL">Register Short URL</a>
</body>
</html>
