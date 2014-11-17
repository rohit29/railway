<!DOCTYPE html>
<html>

<head>
<link href="trainenquiry.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
<div id="header">
</div>

<div id="main">

<?php 

if(isset($_POST['day']) && isset($_POST['date']))
{
	$con = mysqli_connect("localhost","root","rohit","railway");
	

$a="select * from trainday,trainclassdetail where trainday.Trainno=trainclassdetail.Trainno and trainday.{$_POST['day']}='Y'";
$flag=0;
$result=mysqli_query($con,$a);
while($row = mysqli_fetch_array($result))
{
$b="insert into trainstatus values({$row['Trainno']},'{$_POST['date']}',{$row['Sleeper']},{$row['AC3']},0,0)";	

 if ($con->query($b) === TRUE) {
	$flag++;      
	} 
      else {
          echo "<h2>Error: Not inserted in ticket</h2>";
      }

}
if($flag > 0)
{
echo "<h2>Successfully inserted in database of trainstatus</h2>";
}

}
else
{
?>
<div id="box1">
<form name="input" action="<?php $_PHP_SELF?>"  method="post">
Date : <input type="text" name="date"></br> 
Day : <input type="text" name="day"></br> 
<input type="submit" value="Submit">
</form></div>
<?php
}
?>
</div>
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

</body>
</html>



