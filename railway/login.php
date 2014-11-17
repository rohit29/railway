<!DOCTYPE html>
<html>

<head>
	<link href="login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
 session_start();
 $_SESSION['login']=0; 
?>
	<div id="wrapper">
			<div id="header">
			</div>

		<div id="section">
		<?php 
		if($_SESSION['visit']==1)echo "<strong>You must login first</strong><br>";
		$_SESSION['visit']=0;
		?>
			<div id="box">
					<ul>
						<li> <a class="navi" href="http://localhost/railway/loginuser.php">User Login</a>  </li>
							<br>
						<li> <a class="navi" href="http://localhost/railway/loginadmin.php">Admin Login</a>  </li>
							<br>
                        <li> <a class="navi" href="http://localhost/railway/register.php">Register User</a>  </li>
                            <br>
					</ul>
			</div>
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

