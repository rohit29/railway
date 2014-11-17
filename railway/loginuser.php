<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link href="loginuser.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
  <div id="header">
      </div>

  <div id="section">
      <div id="box">
   <form name ="user"     method ="POST">
    <strong align="center">User*</strong> <br> <input size="15"  type ="text"  required="required"   name ="uname" ><br>
    <strong align="center">Password*</strong><br>  <input  size="15" type ="password"  required="required"  name ="password"><br>
    <input type ="submit" value="Login">
    </form></div>
    <?php 
session_start();

   $con  =   mysqli_connect("localhost","root","rohit","railway");
   if($con){
   if(isset($_POST['uname']))
   {
      $sql1    =  "select count(*) from user where Mail_id='$_POST[uname]' and Passwd='$_POST[password]'";
      if($result=mysqli_query($con,$sql1))
         {
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
               if($row['count(*)']==1){echo "welcome";$check=1;}
               else
                  $check=0;
            }
         }
      else
         echo "error".mysqli_error();
  
   if($check==1){
      $sql="select Name from user where Mail_id='$_POST[uname]' and Passwd='$_POST[password]'";
      if($result=mysqli_query($con,$sql)){
         while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            echo "<br>".$row['Name'];
            $newurl="user.php";
            $_SESSION['uname']=$row['Name'];
            $_SESSION['login']=1;
            header('LOCATION: '.$newurl);
         }
      }
      else
         echo "error".mysqli_error();
   }
   else{
      echo "Incorrect username  or password<br>";
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
</div>

</body>
</html>

