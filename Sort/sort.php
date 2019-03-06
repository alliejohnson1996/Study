$test = array(
              "BAAA",
              "BBBB",
              "BCCC",
              "BDDD",
              
              );

function mySort($left, $right) {
    
    $left = $left[1];
    $right = $right[1];
    
    return strcmp($left, $right);
}


usort($test, "mySort");

for($left = 0; $left < count($test); $left++){
    echo $test[$left];
    echo"<br>";
}
