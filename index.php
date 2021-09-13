<?php
include "includes/functions.php";

$slash = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if (strlen($slash) > 0)
    redirectIfAvailable($slash);

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
    <link rel="stylesheet" href="assets/master.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<h1>ReisMiner Short URL Service</h1>
<h2>Create Shorturls for Free</h2>
<form id="urlForm">
    <input name="long" id="input-long" type="text" placeholder="Long URL">
    <input name="short" id="input-short" type="text" placeholder="Short string (optional)">
    <span id="captcha" class="h-captcha" data-sitekey="af47fc96-46be-45e9-b7c3-bfcc9f14a85e" data-theme="dark"></span>
    <a id="submitURL">Register Short URL</a>
</form>
<div id="notification">
    <p class="error"></p>
    <div class="success">
        <h3>URL successfully Shortened!</h3>
        <a id="displayURL"></a>
        <a id="urlCopy">Click to Copy URL</a>
    </div>
</div>

</body>
</html>
