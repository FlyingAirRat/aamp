<?php
  session_start();
  session_destroy();
  setcookie("uid"); 
  setcookie("upw"); 
  header("Location: index.php");