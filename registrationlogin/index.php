#!/usr/local/bin/php
<?php
//these set of instructions is for when the user presses the login button.
if(isset($_POST['login'])){
	/*
	This function checks if the user exists, so that the user is able to log in/validate
	
	@param string $email the inputted email
	@param string $pwd the inputted password
	@param object $filename the file which stores previously registered users to compare the files
	
	@return boolean $state the boolean whether the user already exists or not
	*/
	function checkUserExists($email, $pwd, $filename){

        $file = file_get_contents($filename);
        $file = json_decode($file, true); 
        $state = false;
        foreach ($file as $key => $value) {  
            if(trim($value["email"]) == trim($email) && 
                trim($value["password"]) == trim($pwd) && trim($value["validate"]) == "yes"){ 
                return array($key, $value["email"], $value["password"]);
            } 
        }

        return $state;
    }

	/*
	This function checks if the user password is correct
	
	@param string $pwd the inputted password
	@param object $filename the file which stores previously registered users to compare the files
	
	@return boolean $state the boolean whether the password inputted is correct or not
	*/
	 function checkPassword($pwd, $filename){
        $file = file_get_contents($filename);
        $file = json_decode($file, true);
        $state = false;
        foreach ($file as $key => $value) { 
            if(trim($value["password"]) == trim($pwd)){
                $state = true;
                break;
            } 
        }

        return $state;
    }
	
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (!empty($_POST["email"]) && !empty($_POST["password"]) ) {

            $email = trim($_POST["email"]);
            $psw = trim($_POST["password"]);
            $id =  md5($_POST["email"].$_POST["password"]);
            $filename = 'file.db';
            $file = file_get_contents($filename);
            $file = json_decode($file, true);
            $isUser = checkUserExists($email, md5($psw), $filename); 
			$isPass = checkPassword(md5($psw), $filename); 
			//if the user inputs the correct info, he or she is redirected to the welcome page.
            if(is_array($isUser)){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['users'] = $isUser;
                header('Location: ./welcome.php');
            }
			//if the user inputs the wrong password, he or she is displayed with an "invalid password" message
			elseif(isUser && !$isPass){
				$message= '</p>invalid password'; 
			}
			//otherwise the user id displayed with error message
			else {
                $message= '</p>No such email address. Please register or validate';
            }     

        } 

	}
}

//these set of functions and instructions are for when the user presses register button.
elseif(isset($_POST['register'])){
	
	/*
	This function sends otu emails and stores information of the user
	
	@param string $to the email address that the email is sent to
	@param string $id the id information (email and password)
	
	@return boolean of if the user exists or not
	*/
	function mailing($to, $id){
        $subject = "Validation";
        $link = "http://pic.ucla.edu/~ebaudat/HW5/validate.php?validate=1&id=$id";
        $message = "Validate by clicking this link: $link";
        $mail = mail($to, $subject, $message);

        if($mail) return true;
        else return false;
    }

	/*
	This function checks if the user already exists in the system
	
	@param string $email the email that was inputted by the user
	@param string $file the file that stores all the previously stored users 
	
	@return boolean of if the user exists or not 
	*/
    function checkUserExists($email, $filename){

        $file = file_get_contents($filename);
        $file = json_decode($file, true);

        $state = false;
        foreach ($file as $key => $value) { 
            if(trim($value["email"]) == trim($email)){
                $state = true;
                break;
            } 
        }

        return $state;
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {

            $email = trim($_POST["email"]); 
            $pw =  md5($_POST["password"]);
            $id =  md5($_POST["email"].$_POST["password"]);
            //get the file contents from the database
			try {
                 $file = file_get_contents('file.db');
            } catch (Exception $e) {
                //do something
            }
           
            $file = json_decode($file, true);
            $filename = 'file.db';  
			//initially set the values of the array with inputted information and not validated.
                if (empty($file)){
                    $new = array(
                                 $id => array(
                                              'email' => "$email",
                                              'password' => "$pw",
                                              'validate' => "no"
                                              )
                                 );
                    $db =json_encode($new, JSON_FORCE_OBJECT); 
  
                    $fp = fopen($filename, 'w'); 
                    fwrite($fp, $db); 
                    fclose($fp); 
                    $sendMail = mailing($_POST["email"], $id);

                    $message = '<p>A validation email has been sent to: '.$_POST['email'].' Please follow the link.'."<p><a href='./index.php'>Clear this message</a></p>";


                }
                else if (is_array($file)){
                    $new =  array('email' => "$email",'password' => "$pw", 'validate' => "no");
                    $file["$id"] = $new;
                    $db =json_encode($file,JSON_FORCE_OBJECT);

                    $isUser = checkUserExists($_POST["email"], $filename); 
                    //if the user doesnt exist alraedy, a validation email will be sent.
					if(!$isUser) { 

                        $fp = fopen($filename, 'w'); 
                        fwrite($fp, $db); 
                        fclose($fp); 
                        $sendMail = mailing($_POST["email"], $id);

						$message = '<p>A validation email has been sent to: '.$_POST['email'].' Please follow the link.'."<p><a href='./index.php'>Clear this message</a></p>";

                    } else { //if the user has already been registered
						$message = '<p>Already registered. Please log in/validate.</p>'."<p><a href='./index.php'> Clear this message</a></p>";
                    } 

                }
 
        }
        else {die('Fields are empty');}  
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Home</title>
                    
</head>
<body>
<!--Echo filename of the currently executing script, relative to the document root -->
<form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <div class="container">
		<h1>Home</h1>
		<hr>
		<fieldset>
			<b>email address: </b><input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must contain some string of characters before an ’@’ symbol, followed by another string of characters" required>
			<br />
			<b>password (<span>&#8805;</span> 6 characters letters or digits): </b><input type="password" name="password" pattern="[a-zA-Z0-9].{6,}" title="Must be at least 6 characters, with letters (upper and lowercase) and digits only" required>
		</fieldset>
		<div>
			<input type="submit" name="register" value="register"> 
			<input type="submit" name="login" value="login"> 
		</div>
	</div>
	<?php echo $message; ?>
</form>
</body>
</html>

