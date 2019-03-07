#!/usr/local/bin/php

<?php
    if(isset($_POST['submit'])){
        $file = $_FILES['picName']; //superglobal of the file
        //array that holds
        //Array([name]=> name.jpg [type]=> image/jpeg (tmp_name]=> location
        
        $fileName = $file['name']; //takes the name of file
        $fileTmpName = $file['tmp_name']; //local file destination
        $fileDestination = 'uploads/'.$fileName; //takes the local destination and appends it to the folder you want to move it into
        
        move_uploaded_file($fileTmpName, $fileDestination);
        echo "$fileDestination";
        echo "<img src=".$fileDestination." />";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>upload page</title>
</head>
<body>
    <main>
    </main>

</body>
</html>
