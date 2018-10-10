<?php
  $username = "postgres";
  $password = "postgres";
  $host = "localhost";
  $port = '5432';
  $database = "market_online";

  $dbconn = pg_connect("host=$host port=$port dbname=$database user=$username password=$password");
?>