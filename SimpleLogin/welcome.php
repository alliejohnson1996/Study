#!/usr/local/bin/php
/*<?php
    session_name('Demo'); // name the session
    session_start(); // start a session
?>*/

<!DOCTYPE html>
<?php
    if(!isset($_SESSION['loggedin']) or !$_SESSION['loggedin']){ ?>
        <html>
        <head>
            <title>Unwelcome</title>
        </head>
        <body>
            <p>Go back and log in</p>
        </body>
        </html><?php
    }
    else { //thenlogin successful
    ?>
<html>
<head>
        <title>Welcome</title>
</head>
<body>
        <p>Welcome!</p>
        <br>
        <p><b><i>Company people:</b></i></p>
    <?php
        $file = fopen('company.txt','r');
        while(! feof($file)){
            echo fgets($file)."<br />";
        }
        fclose($file);
    ?>

</body>
</html> <?php
}?>
