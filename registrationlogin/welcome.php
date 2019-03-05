#!/usr/local/bin/php
<?php

session_start();
/*
This function takes the file with information of the registered users and displays it.

@param object $file file with information of the registered users

@return the validated emails 
*/
	function displayUsers($file){
		$file = file_get_contents($file);
		if(empty($file)){
			echo "";
		}
		else {
			$file = json_decode($file, true);
			foreach ($file as $key => $value) {
			if($value["validate"] == "yes")
				print $value["email"] . " "; 
			}
		}
		
	}


?>


<!DOCTYPE html>
<html lang="en">
<?php

 // either there no session or not logged in
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){ 
		header("Location: ./"); 
	}
    else { 
?>
<head>
	<title>Welcome</title>
</head>
<body>
	<!--Display the registered email and the list of other registered addresses-->
	<p>Welcome! Your email is <?php echo $_SESSION['users'][1]; ?></p>
	<p>Here is a list of registered addresses: <?php displayUsers("file.db"); ?></p>
	<p><a href="./logout.php">Logout</a></p>
</body>
</html> 
<?php
 }?>
