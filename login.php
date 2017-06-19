<html>
<head>
<style>

input.button{
cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
padding:0.8px 15px; /*add some padding to the inside of the button*/
background:#35b128; /*the colour of the button*/
border:1px solid #33842a; /*required or the default border for the browser will appear*/
/*give the button curved corners, alter the size as required*/
-moz-border-radius: 10px;	
-webkit-border-radius: 10px;
border-radius: 10px;
/*give the button a drop shadow*/
-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
box-shadow: 0 0 4px rgba(0,0,0, .75);
}

input.button:hover, input#gobutton:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}

html { background-image:url('back1.jpg');background-attachment:fixed; }
body { border-radius: 25px;margin-left:1.5cm;margin-right:1.5cm; background-image: url('background1.jpg'); }
p{ margin-left:11cm; }
</style>
</head>


<?php
session_start();
if(isset($_SESSION['username']))header('location:homepage.php');
echo '
<table>
<br><br><form method="POST" action="mainpage.php">
<tr><td><p>Email:</td> <td><input type=text name="email"></p></td></tr>
<tr><td><p>Password: </td> <td><input type=password name="password"></p></td></tr>
<tr><td><input class="button" style="font-family:Courier New;background-color:green;color:white;margin-left:11cm;" type=submit name="loginbutton" value="Login"><br>
</td></tr></form>
</table>';
?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</html>
