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
<main>
    <h1>ReisMiner Short URL Service</h1>
    <h2>Create Shorturls for Free</h2>
    <input name="long" id="input-long" type="text" placeholder="Long URL">
    <input name="short" id="input-short" type="text" placeholder="Short string (optional)">
    <div id="captcha" class="h-captcha" data-sitekey="af47fc96-46be-45e9-b7c3-bfcc9f14a85e" data-theme="dark"></div>
    <a id="submitURL">Register Short URL</a>
    <p class="error">Captcha Invalid</p>
    <div style="text-align: center">
        <h3 class="success">URL successfully Shortened!</h3>
        <a class="success" id="displayURL">https://s.reisminer.xyz/abcdef</a>
    </div>
    <a class="success" id="urlCopy">Click to Copy URL</a>
</main>
</body>
</html>
