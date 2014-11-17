<!DOCTYPE html>
<html>
<head>
	<title>user reg.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="register.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
			<div id="header">
			</div>

		<div id="section">
			<div id="box">
   <form name ="user"     method ="POST">
   	<strong align="center">Name*</strong> <br><input   size="15" type="text" required="required" name ="name" ><br>
   	<strong align="center">Address</strong> <br><input  size="20" type ="text" name ="address"><br>
   	<strong align="center">Phone no*</strong> <br><input  size="15" type ="int" required="required" name ="phone"><br>
   	<strong align="center">e-mail*</strong> <br><input  size="15" type ="text"  required="required"  name ="mail_id"><br>
   	<strong align="center">Age</strong> <br><input  size="10" type ="int"  name ="age"><br>
	<strong align="center">Gender</strong> <br><input type="radio"  name ="gender" value="M">Male
	   				<input type="radio" name ="gender" value="F">Female<br>
   	<strong align="center">Password*</strong> <br><input size="15"  type ="password" required="required"  name ="password"><br>
   	<input type ="submit" value="Sign Up">
   	</form></div>
<?php  session_start();  $check=0;
 	$con 	=	 mysqli_connect("localhost","root","rohit","railway");
 	if($con){
 	if(isset($_POST['name']))
	{
 	 	$sql1 	=	"insert into user (Name,Gender,Age,Mobileno,Mail_id,Passwd,Address) values ('$_POST[name]','$_POST[gender]'
 			,'$_POST[age]','$_POST[phone]','$_POST[mail_id]','$_POST[password]','$_POST[address]')";
	
		if(mysqli_query($con,$sql1))
			{   $newurl="login.php";
            $_SESSION['name']=$_POST['name'];
            header('LOCATION: '.$newurl);
			}
		else
			echo "error".mysqli_error();
	
	}
}

else
	echo "failed connection ".mysqli_connet_error();
?>
</div>

		<div id="footer">
				<ul>
					<li><img src="Home.png" /></li>
						<br>
					<li><img src="Logout.png" /></li>
						<br>
				</ul>
		</div>
	</div>
</body>
</html>
