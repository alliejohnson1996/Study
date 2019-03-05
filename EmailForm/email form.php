#!/usr/local/bin/php

<?php
    $statusMsg = '';
    $msgClass = '';
    if(isset($_POST['submit'])){
        // Get the submitted form data
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        // Send email
        if(mail($email,$subject,$message)){
            $statusMsg = 'Your contact request has been submitted successfully !';
            $msgClass = 'succdiv';
        }else{
            $statusMsg = 'Your contact request submission failed, please try again.';
            $msgClass = 'errordiv';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email Page</title>
</head>
<body>
    <main>
        <h2>Email Page</h2>
        <div class="contactFrm">
        <?php if(!empty($statusMsg)){ ?>
        <p class="statusMsg <?php echo !empty($msgClass)?$msgClass:''; ?>"><?php echo $statusMsg; ?></p>
        <?php
        } ?>
        <form action="" method="post">
        <h4>Email </h4>
        <input type="email" name="email" placeholder="email@example.com" required="">
        <h4>Subject</h4>
        <input type="text" name="subject" placeholder="Write subject" required="">
        <h4>Message</h4>
        <textarea name="message" placeholder="Write your message here" required=""></textarea>
        <br/>
        <input type="submit" name="submit" value="Submit">
        <div class="clear"> </div>
        </form>
        </div>
    </main>
</body>
</html>
