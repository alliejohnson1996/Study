#!/usr/local/bin/php
<?php
  // response type will be text
  header("Content-Type: text/plain; charset=utf-8");
  
  // decode as an object
  $client = json_decode($_POST['client'], false);
   
  $file = fopen('contacts.txt', 'a'); // edit the contacts file
  
  if($file){ // if we could open the file to append
    fwrite($file, "{$client->company}\t{$client->name}\t{$client->email}\t");
    for($i=0; $i<100; ++$i){ // add extra space: in case need to edit things later
      fwrite($file, ' ');
    }
    fwrite($file, "\n");   
    echo 'written'; // tell there was success
  }
  else{ // given a warning in this case    
    echo 'file fail';
  } 
  fclose($file);
?>