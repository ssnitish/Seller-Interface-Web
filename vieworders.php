<head>
<meta http-equiv="refresh" content="5" > 
<title>View Orders</title>
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
<input class="button" style="background-color:#B8D000;font-family:Courier New;color:white;" type=submit name=vieworders value="View Orders">
</form></td>
			<td><form method="POST" action="viewitem.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=viewbutton value="View Items">
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
		
	//View details of orders made in tabular form
	$sql='select orderid, userid, order1, quantity, time, price from result order by orderid desc;';
	$result= mysqli_query($conn,$sql);
	echo '<br><table border="1" style="border-collapse:collapse;width:70%;margin:0px 0px 0px 175px;"><tr><th><b>OrderID</b></th><th><b>Username</b></th><th><b>Order</b></th><th>Time(min)</th><th>Price(Rs.)</th></tr>';
	while($row=mysqli_fetch_array($result)){
		$items = $row[2];
		$quantity= $row[3];
		$token1 = strtok($items, ",");

	echo '<tr><td style="color:#006400;font-family:Courier New;"><i>'.$row[0].'</i></td><td>'.$row[1].'</td>';
	
	echo '<td><table border="1"><tr>';
	while ($token1 !== false){
		echo "<td>$token1</td>";
		$token1 = strtok(",");
	}
	echo '</tr>';
	$token2 = strtok($quantity, ",");
	echo '<tr>';
	while ($token2 !== false){
		echo "<td>$token2</td>";
		$token2 = strtok(",");
	}
	echo '</tr></table></td>';
	
	echo '<td>'.$row[4].'</td><td>'.$row[5].'</td>
			</tr>';
	}
	echo "</table>";
	
}
else{
	echo 'You are not logged in!
	<meta http-equiv="refresh" content="2;url=login.php">';
}
echo '<hr><br>';
?>


