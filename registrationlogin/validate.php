#!/usr/local/bin/php
<?php


	if (isset($_GET["validate"]) && isset($_GET["id"])) {
		//if the inputted id is the same as the registered id
        $id = $_GET["id"];
		//update the file.db
        $file = file_get_contents('file.db');
        $file = json_decode($file, true); 
        
		$pos = 0;
        $new = array();
		//if the new key is the same as the stored value, update the 'validate' value to yes
        foreach ($file as $key => $value) {
            $pw = $value["password"]; 
            $email = $value["email"];
            $validate = $value["validate"];
            if ($key == $id) {
                $new[$key] = array(
                    'email' => "$email",
                    'password' => "$pw",
                    'validate' => "yes"
                );
            } else {
                $new[$key] = array(
                    'email' => "$email",
                    'password' => "$pw",
                    'validate' => "$validate"
                );
            }
            $pos++;
        }
        $filename = 'file.db';
        unlink($filename);
        
        $db =json_encode($new, JSON_FORCE_OBJECT);
        $fp = fopen($filename, 'w'); 
        fwrite($fp, $db); 
        fclose($fp); 
		//finally display that the email is validated
        echo '<p>Email validated!</p>';
		echo "<p><a href='./index.php'>Log In</a></p>";
    }

?>