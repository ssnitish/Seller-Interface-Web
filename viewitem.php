<head><title>View items</title>
<style>
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

a:hover{color:maroon;}
</style></head>


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
<input class="button" style="background-color:#B8D000;font-family:Courier New;color:white;" type=submit name=viewbutton value="View Items">
</form></td>
			<td><form method="POST" action="additem.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=addbutton value="Add Items">
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
	
	//Only execute when update button is pressed
if(isset($_POST['update'])){
	//Update the details of items and then show in tabular form
	if($_POST['itemname']){
	$sql='UPDATE item SET itemname= "'.$_POST['itemname'].'" WHERE itemid='.$_POST['itemid'].';';
	mysqli_query($conn, $sql);
	}
	if($_POST['unitprice']){
	$sql='UPDATE item SET unitprice= "'.$_POST['unitprice'].'" WHERE itemid='.$_POST['itemid'].';';
	mysqli_query($conn, $sql);
	}
	if($_POST['preptime']){
	$sql='UPDATE item SET time= "'.$_POST['preptime'].'" WHERE itemid='.$_POST['itemid'].';';
	mysqli_query($conn, $sql);
	}
}

$i=1;
for(;$i<=1000;$i++){
if(isset($_POST['delete'.$i])) break;
}

if($i<=1000){
	//Delete an item from the item table & category table and then show details of items in tabular form
	$sql='delete from category where itemid='.$i.';';
	mysqli_query($conn,$sql);
	$sql='delete from item where itemid='.$i.';';
	mysqli_query($conn,$sql);
	$sql='select itemid, itemname,unitprice,imagename,time from item order by itemid;';
	$result= mysqli_query($conn,$sql);
	echo '<br><table border="1" style="border-collapse:collapse;width:70%;margin:0px 0px 0px 175px;"><tr><th><b>Item ID</b></th><th><b>Item name</b></th><th><b>Unit price</b></th><th><b>Image name</b></th><th><b>Preparation time(minutes)</b></th></tr>';
	while($row=mysqli_fetch_array($result)){
	echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].'</i></td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td>
		<td><form method="POST" action="viewitem.php">
			<input class="button" type=submit name=edit'.$row[0].' value="Edit">
			</form></td>
			<td>
			<form method="POST" action="viewitem.php">
				<input class="button" type=submit name=delete'.$row[0].' value="Delete">
			</form>
			</td></tr>';
	}
	echo "</table>";
	exit();
}

$i=1;
for(;$i<=1000;$i++){
if(isset($_POST['edit'.$i])) break;
}

if($i<=1000){
	//Editable details of items in tabular form
	$sql='select itemid, itemname,unitprice,imagename,time from item order by itemid;';
	$result= mysqli_query($conn,$sql);
	echo '<br><table border="1" style="border-collapse:collapse;width:70%;margin:0px 0px 0px 175px;"><tr><th><b>Item ID</b></th><th><b>Item name</b></th><th><b>Unit price</b></th><th><b>Image name</b></th><th><b>Preparation time(minutes)</b></th></tr>';
	while($row=mysqli_fetch_array($result)){
		if($row[0]==$i){
		echo '<tr><form method="POST" action="viewitem.php"><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].'</i><input type="hidden" name="itemid" value="'.$row[0].'"></td><td>'.$row[1].' <input class="textbox" type="text" name="itemname"></td><td>'.$row[2].' <input class="textbox" type="text" name="unitprice"></td><td>'.$row[3].'</td><td>'.$row[4].' <input class="textbox" type="text" name="preptime"></td>
		<td>
			<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=update value="Update">
		</form></td></tr>';	}
		else{
	echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].'</i></td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td>
		<td><form method="POST" action="viewitem.php">
			<input class="button" style="background:#B8D000;" type=submit name=edit'.$row[0].' value="Edit">
		</form></td>
		<td>
			<form method="POST" action="viewitem.php">
				<input class="button" style="background:#B8D000;" type=submit name=delete'.$row[0].' value="Delete">
			</form>
		</td>
		</tr>';}
	}
	echo "</table>";
}
else{
	//View details of items in tabulr form
	$sql='select itemid, itemname,unitprice,imagename,time from item order by itemid;';
	$result= mysqli_query($conn,$sql);
	echo '<br><table border="1" style="border-collapse:collapse;width:70%;margin:0px 0px 0px 175px;"><tr><th><b>Item ID</b></th><th><b>Item name</b></th><th><b>Unit price</b></th><th><b>Image name</b></th><th><b>Preparation time(minutes)</b></th></tr>';
	while($row=mysqli_fetch_array($result)){
	echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].'</i></td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td>
		<td><form method="POST" action="viewitem.php">
			<input class="button" style="background:#B8D000;" type=submit name=edit'.$row[0].' value="Edit">
			</form></td>
			<td>
			<form method="POST" action="viewitem.php">
				<input class="button" style="background:#B8D000;" type=submit name=delete'.$row[0].' value="Delete">
			</form>
			</td></tr>';
	}
	echo "</table>";
	}	
}

else{
	echo 'You are not logged in!
	<meta http-equiv="refresh" content="2;url=login.php">';
}
echo '<hr><br>';
?>


