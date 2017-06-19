<?php
session_start();
session_destroy();
echo '<p style="color:brown;font-family:Courier New;">You have now logged out!<br></p>Redirecting to loginpage...';
?>
<html>
<head>
<title>Logout</title>
<meta http-equiv="refresh" content="2;url=login.php">
</head>
</html>