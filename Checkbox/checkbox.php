

<!DOCTYPE html>
<html lang="en">
<head>
<title>Email Page</title>
</head>
<body>
<main>

<form id="byGet" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="checkbox" name="x[]" value="A">A<br/>
<input type="checkbox" name="x[]" value="B">B<br/>
<input type="checkbox" name="x[]" value="C">C<br/>
<input type="submit" value="GET" /> </form>

<?php
    if(isset($_GET['x'])){ // ensure was set
        $checks = $_GET['x']; // store array as $checks
        if (count($checks)===0){ // size 0 means no checks
            ?>
<h2>Nothing was checked</h2> <?php
    }
    else{ // something was selected
        foreach($checks as $selected){ // go through each selection
            echo $selected, " was chosen. ";
        }
        
    }  }
    ?>

</p>
</main>
</body>
</html>



