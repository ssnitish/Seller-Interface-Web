<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname= 'project';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
   if (mysqli_connect_errno())
   die('Could not connect: '.mysql_error());
?>
