<?php
  
  $db_connect = mysqli_connect('localhost', 'fred', 'babu1234', 'babupizza');

  if(!$db_connect) {
  	echo 'Connection error: ' . mysqli_connect_error();
  }

?>