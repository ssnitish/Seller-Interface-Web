<head><title>Mainpage</title>
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
		
	if(isset($_POST['updateacc'])){
		$newemail= $_POST['email'];
		$currentpass= $_POST['currentpass'];
		$newpass= $_POST['newpass'];
		
		$sql='select email, password from seller;';
		$result=mysqli_query($conn, $sql);
		$row=mysqli_fetch_array($result);
		$truepass=$row[1];
		
		if(!strcmp($currentpass,$truepass)){
			$sql= 'update seller set email="'.$newemail.'" ,password="'.$newpass.'"';
			mysqli_query($conn, $sql);
			echo 'Details updated!';
			echo '<meta http-equiv="refresh" content="2;url=manageacc.php">';
			exit();
		}
		else{
				echo 'Wrong password!';
				session_destroy();
				echo '<meta http-equiv="refresh" content="2;url=login.php">';
				exit();
		}
	}
		
	if($_POST['pname']&&$_POST['pcategory']&&$_POST['unitprice']&&$_POST['iname']){
		
		$pname= $_POST['pname'];
		$pcategory= $_POST['pcategory'];
		$unitprice= $_POST['unitprice'];
		$iname= $_POST['iname'];
		$time= $_POST['time'];
		
		//Uploading image by browse
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      
      
      if($file_size > 20971520) {
         $errors[]='File size limit is 20 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
		 rename("images/".$file_name, "images/".$iname.".jpg");
      }else{
         print_r($errors);
      }
   }
	
		
		//Blobbing
		$imagepath= 'C:\wamp\www\project\images\\'.$iname.'.jpg';
		$imgData = file_get_contents($imagepath, FILE_USE_INCLUDE_PATH);
		$size = getimagesize($imagepath);
		$sql = sprintf("INSERT INTO item (itemname, unitprice, image, imagename, time)
					   VALUES('%s', '%d', '%s', '%s', '%s')",
			   $pname,
			   $unitprice,
			   mysqli_real_escape_string($conn, $imgData),
			   $iname,
			   $time
			);
		mysqli_query($conn,$sql);
		
		//Assigning category to a specific item
		$sql='SELECT itemid FROM item where imagename="'.$iname.'";';
		$result= mysqli_query($conn,$sql);
		$row = $result->fetch_array(MYSQLI_NUM);
		$pid= $row[0];
		$sql= 'INSERT INTO category (categoryid, itemid) VALUES ("'.$pcategory.'","'. $pid.'");';
		mysqli_query($conn,$sql);
		$sql= 'UPDATE item SET itemcategory= "'.$pcategory.'" WHERE imagename= "'.$iname.'";';
		mysqli_query($conn,$sql);
		
		echo '<b>The item was successfully added.</b>';
		echo '<meta http-equiv="refresh" content="2;url=additem.php">';
		exit();
	}
	else {
		echo '<b>Error: You need to fill all the fields!</b>';
		echo '<meta http-equiv="refresh" content="2;url=additem.php">';
		exit();
	}
	
}
else if(isset($_POST['loginbutton'])){
	echo '<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp';
	$uname=mysqli_real_escape_string($conn, $_POST['email']);
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	//$password=md5($password);
	$sql='select * from seller where email="'.$uname.'" and password="'.$password.'";';

	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)==1){
		echo '<table>
		<tr>
			<td><form method="POST" action="vieworders.php">
<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name=vieworders value="View Orders">
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
	$_SESSION['email']=$uname;
	}
	else {echo '<br><p style="text-indent:8cm;font-family:Courier New;color:brown;">Invalid login! Either username or password incorrect.<br></p><p style="text-indent:8cm;font-family:Courier New;color:brown;">Please login for admin privilege.<p>';
	echo '<form method="POST" action="login.php">
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<input class="button" style="background-color:green;font-family:Courier New;color:white;" type=submit name="loginbutton" value="Login">
		</form>';
		}
} 
echo '<hr><br>';
?>


