<?php
  define("URL", "localhost");
  define("USERNAME", "ga243");
  define("PASSWORD", "ga243!@ga243!@");
  define("DBNAME", "aamp");
  define("PORT", "3306");

  function get_conn()
  {
    return mysqli_connect(URL, USERNAME, PASSWORD, DBNAME, PORT);
  }
