# short-url-php
A self-made URL shortener written in PHP and JavaScript.
Has a captcha validation and tracks the hits for each link.

Live Demo here: https://s.reisminer.xyz

# How to self host?

- Clone this repo
- add a config.php file in ./includes/ with the following contents and variable names
```php
$db_user = "DATABASE-USER";
$db_pw = "DATABASE-PASSWORD";
$db_host = "DATABASE-HOST";
$db_db = "DATABASE-NAME";

$hcaptcha_secret = "0xH-CAPTCHA SECRET!!!";
$webhost = "YOUR-DOMAIN. E.G: https://s.reisminer.xyz/"
```
- optional change the error messages in ./assets/main.js
- make a database with one table called `links`. The table has following Columns: `url_key [varchar(16)], long_url [text], hits [int], added_by_ip [varchar(30)], added_at_date [datetime]`.
- last step: upload to a webserver and enjoy!
