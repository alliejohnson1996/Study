<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="text" name="username"/>
    <input type="submit" name="submit" value="submit" />

<p>
<?php
    if(isset($_POST['submit'])){
        echo $_POST['username'];
    }
?>
</p>

</body>
</html>

