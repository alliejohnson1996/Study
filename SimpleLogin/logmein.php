#!/usr/local/bin/php
<?php
 //session_name('Demo'); // name the session
 //session_start(); // start a session
 $_SESSION['loggedin'] = false; // have not logged in
 

 function validate($password, &$error){
     $fin = fopen('company.txt', 'r'); // open file to read
     while(!feof($fin)){ //if it hasnt reached the end of file
         $line= fgets($fin);
         $true_pass = $line;
         
         $true_pass = trim($true_pass);
 
 if($password === $true_pass){ // if they match, great
     $_SESSION['loggedin'] = true;
 header('Location: welcome.php');
 } else { // bad password
 $error = true;
 }
}
     fclose($fin);
 }
 
    $error=false;
 if(isset($_POST['pass'])){ // if something was posted
    validate($_POST['pass'], $error); // check it
 }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
</head>
<body>
    <main>
        <form method = "post" action ="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="password" name="pass" />
        <input type="submit" value="log in" />
        <?php if($error){ // wrong password
            ?>
        <p>Sorry Invalid Login!</p> <?php
        } ?>
    </form>
    </main>
</body>
</html>
