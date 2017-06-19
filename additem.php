<head>
<title>Additem</title>

<style>
/* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
@media screen and (-webkit-min-device-pixel-ratio:0) {
    select {padding-right:18px}
}

/***TEXTBOX STYLES***/ 
 .textbox { 
    background: #F3FFE7 ; 
    border: 1px solid #DDD; 
    border-radius: 5px; 
    box-shadow: 0 0 1px #000 inset; 
    color: #000; 
    outline: none; 
    height:20px; 
    width: 175px; 
   } 

/***FIRST STYLE THE BUTTON***/
input.button{
cursor:pointer; /*forces the cursor to change to a hand when the button is hovered*/
padding:0.5px 15px; /*add some padding to the inside of the button*/
background:#35b128; /*the colour of the button*/
border:1px solid #33842a; /*required or the default border for the browser will appear*/
/*give the button curved corners, alter the size as required*/
-moz-border-radius: 3.5;
-webkit-border-radius: 3.5px;
border-radius: 3.5px;
/*give the button a drop shadow*/
-webkit-box-shadow: 0 0 4px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 4px rgba(0,0,0, .75);
box-shadow: 0 0 4px rgba(0,0,0, .75);
}

/***NOW STYLE THE BUTTONS HOVER AND FOCUS STATES***/
input.button:hover, input#gobutton:focus{
background-color :#399630; /*make the background a little darker*/
/*reduce the drop shadow size to give a pushed button effect*/
-webkit-box-shadow: 0 0 1px rgba(0,0,0, .75);
-moz-box-shadow: 0 0 1px rgba(0,0,0, .75);
box-shadow: 0 0 1px rgba(0,0,0, .75);
}
</style>
</head>


<?php
require('connect.php');

//create login session here
session_start();
if(isset($_SESSION['email'])){
	$uname=$_SESSION['email'];
	echo '<table>
		<tr>
			<td><form method="POST" action="vieworders.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=viewbutton value="View Orders">
</form></td>
			<td><form method="POST" action="viewitem.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=viewbutton value="View Items">
</form></td>
			<td><form method="POST" action="additem.php">
<input class="button" style="background-color:#B8D000;font-family:Courier New;color:white;" type=submit name=addbutton value="Add Items">
</form></td>
			<td><form method="POST" action="viewuser.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=viewuserbutton value="View Users">
</form></td>
			<td><form method="POST" action="manageacc.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=manageacc value="Manage Account">
</form></td>
			<td><form method="POST" action="logout.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=logoutbutton value="Logout">
</form></td>
		</tr>
		</table>';
		
	echo '<form action="mainpage.php" method="post" enctype = "multipart/form-data">
<table border="0" cellpadding="4" style="cell-spacing:5px;border-collapse:collapse;">
<tr><td>Item name:</td><td> <input class="textbox" type="text" name="pname"><br></td></tr>
<tr><td>Item category:</td><td>  <select name="pcategory">
  <option value="101">Paratha</option>
  <option value="102">Rice</option>
  <option value="103">Curry</option>
  <option value="104">Snacks</option>
  <option value="105">Drinks</option>
</select></td></tr>
<tr><td>Unit price:</td><td> <input class="textbox" type="int" name="unitprice"><br></td></tr>
<tr><td>Image:</td><td> <input type = "file" name = "image" ></td></tr>
<tr><td>Image name:</td><td> <input class="textbox" type="text" name="iname"><br></td></tr>
<tr><td>Time:</td><td> <input class="textbox" type="time" name="time"><br></td>
	<td><input class="button" style="background:#B8D000;" name="addbutton" value="Add" type="submit"></td></tr>
</table>
		</form>';
}
else{
	echo 'You are not logged in!
	<meta http-equiv="refresh" content="2;url=login.php">';
}
echo '<hr><br>';
?>


