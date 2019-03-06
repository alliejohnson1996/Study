#!/usr/local/bin/php
<?php
    //header('Content-type: image/jpeg');
    if(isset($_FILES['image'])){
        $errors= array();
        $file_name = $_FILES["image"]["name"];
        $file_tmp = $_FILES["image"]["tmp_name"];
        $file_type = $_FILES["image"]["type"];
        $file_ext=strtolower(end(explode('.',$_FILES["image"]["name"])));
        
        $extensions= array("jpeg","jpg","png");
        
        while(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if(empty($errors)==true) {
            move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);
            echo "Stored in: " . "upload/" . $_FILES["image"]["name"]."<br>";
            $image=$_FILES["image"]["name"]; /* Displaying Image*/
            $img="upload/".$image;
            echo '<img src= "'.$img.'">';
        
        }else{
            print_r($errors);
        }
    }
    ?>
<html>
<body>

<form action = "" method = "POST" enctype = "multipart/form-data">
<input type = "file" name = "image" />
<input type = "submit"/>

<ul>
<li>Sent file: <?php echo $_FILES["image"]["name"];  ?>
<li>File type: <?php echo $_FILES["image"]["type"] ?>
</ul>

</form>

</body>
</html>
