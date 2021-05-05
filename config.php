<?php
 define('DB_SERVER','purna1.mysql.database.azure.com');
 define('DB_USER','purnachandra@purna1');
 define('DB_PASS' ,'Purna@29');
 define('DB_NAME', 'vellalap1');
 $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
 if (mysqli_connect_errno())
 {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
?>