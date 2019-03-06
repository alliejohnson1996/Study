#!/usr/local/bin/php
<?php
define('DAY', 86400); # seconds per day
$name = 'user';
$value = 'Joe Bruin';
setcookie($name, $value, time() + DAY, '/');
?>
<!DOCTYPE html>
<html>
<head>
<title>Page</title>
<script src="cookie.js" defer></script>
</head>
<body>
<p>
<input type="button" value="show cookie" onclick="alert(document.cookie);" />
<input type="button" value="add cookie" onclick="add();" />
</p>
<p>
<?php
if(isset($_COOKIE['user'])) { // if cookie user set
    echo $_COOKIE['user'], "<br/>";
}
if(isset($_COOKIE['pet'])) { // if cookie pet set
    echo $_COOKIE['pet'], "<br/>";
}
?>
</p>
</body>
</html>
