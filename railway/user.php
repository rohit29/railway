<!DOCTYPE html>
<html>

<head>
<link href="user.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>

$(function() {
$( "#datepicker" ).datepicker();
});

</script> 
<body>
<div id="wrapper">
<div id="header">
 <?php   
 session_start(); 
 if($_SESSION['login']==1){      
echo "Welcome ". $_SESSION['uname']."<br>";}?>
        </div>

<div id="main">
<?php 
if($_SESSION['login']==1){
$station=array();
   $con =mysqli_connect("localhost","root","rohit","railway");
   if($con){
   $sql1="select * from station";
   if($result=mysqli_query($con,$sql1)){
    $a=0;
   while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $station[$a]=$row['Sname'];$a++;}
    }
   }
   #$station =array("hii","look");
?>
<div id="nav">
<h1>Book Ticket</h1>
<br>
<form name="book" action="bookticket.php" method="post">
Source: <select name="source" required="required" >
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
</select> <br>
Destination: <select name="destination" required="required" >
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
        </select><br>

Date: <input size="10" type="text"  id ="datepicker" name="date"><br>
<input type="submit" value="Submit">
</form> 
</p>

</div>

<div id="section">
<div id="box">
<p>
<ul>

    <li> <a class="navi" href="http://localhost/railway/cancel1.php">Cancel</a>  </li>

    <br>

    <li> <a class="navi" href="http://localhost/railway/pnrstatus.php">PNR Status</a>  </li>

    <br>

        <li> <a class="navi" href="http://localhost/railway/trainenquiry.php">Train Detail</a>  </li>

    <br>

<br>
</ul>

<br>
</p>
</div>
</div>
</div>
<?php  }
else
{
    $_SESSION['visit']=1;
    echo "You must Login First";
    $url="login.php";
    header('LOCATION: '.$url);
}
?>
<div id="footer">
            <p>
                <ul>
                    <li><img src="Home.png" /></li>
                        <br>
                    <li><img src="Logout.png" /></li>
                        <br>
                </ul>
            </p>
</div>
</div>

</body></head>
</html>

