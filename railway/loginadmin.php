<!DOCTYPE html>
<html>

<head>
    <link href="loginadmin.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>



<div id="wrapper">
    <div id="header">
    </div>
<div id="section">
<div id="box">
   <form name ="user"     method ="POST" >
    <strong align="center">User*</strong> <br><input  size="15" type="text"    name ="name" ><br>
    <strong align="center">Password*</strong><br>  <input size="15" type ="password"  name ="password"><br>
    <input type ="submit" value="Login">
</form>
</div>
<?php  session_start();
    $con    =    mysqli_connect("localhost","root","rohit","railway");
    if($con){
    if(isset($_POST['name']))
    {
        $sql1   =   "select count(*) from admin where username='$_POST[name]' and passwd='$_POST[password]'";
        if($result=mysqli_query($con,$sql1))
            {
                $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                if($row['count(*)']==1){
                    $check=1;
                }
                else
                    $check=0;
            }
        else
            echo "error".mysqli_error();
        if($check==1){
                $_SESSION['uname']=$_POST['name'];
                $newurl="admin.php";
                header('LOCATION: '.$newurl);
            }   
        else
        {
            echo "incorrect username and password";
        }
    
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

</body>
</html>

