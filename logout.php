<?php
  session_start();
  session_destroy();
  unset($_COOKIE['uid']);
  unset($_COOKIE['upw']);
  header("Location: index.php");