<?php
  
  include('config/db_connect.php');

  $_SESSION = [];

  session_unset();
  session_destroy();

  header('Location: login.php');
?>