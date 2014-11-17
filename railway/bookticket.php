<!DOCTYPE html>
<html>

<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 3px;
}
</style>

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
</head>
<body>
<div id="wrapper">
<div id="header">
 <?php
 session_start();       
echo "Welcome ". $_SESSION['uname']."<br>";?>
        </div>

<div id="main">
<?php 
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
Source: <select name="source" required="required">
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
</select> <br>
Destination: <select name="destination" required="required">
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
        </select>

Date: <input size="10" type="text"  id ="datepicker" name="date">
<input type="submit" value="Submit">
</form> 
</p>

</div>

<div id="section">
<p>
<?php
session_start();
$_SESSION['source']=$_POST['source'];
$_SESSION['destination']=$_POST['destination'];
$date=$_POST['date'];
$date1=$date;
$date1[0]=$date[6];
$date1[1]=$date[7];
$date1[2]=$date[8];
$date1[3]=$date[9];
$date1[4]='-';
$date1[5]=$date[0];
$date1[6]=$date[1];
$date1[7]='-';
$date1[8]=$date[3];
$date1[9]=$date[4];

$_SESSION['date']=$date1;
//echo $_SESSION['source'];
$con = mysqli_connect("localhost","root","rohit","railway");
	if(!$con)
	{
		echo("<p>Connection to content server failed.</p>");
		exit();
	}
	else
	{
	//$a=$a="select train.Trainno,train.Train_name,train.Type,trainday.Mon,trainday.Tue,trainday.Wed,trainday.Thu,trainday.Fri,trainday.Sat,trainday.Sun from train,trainday where train.Trainno=trainday.Trainno and Source='{$_POST['source']}' and Destination='{$_POST['destination']}'";	

$a="select trainclassdetail.Sleeper,trainclassdetail.AC3,train.Trainno,train.Train_name,train.Type,trainstatus.Date,trainstatus.Available_Sleeper as a,trainstatus.Available_AC3 as b,trainstatus.Waiting_Sleeper as c,trainstatus.Waiting_AC3 as d,trainday.Mon,trainday.Tue,trainday.Wed,trainday.Thu,trainday.Fri,trainday.Sat,trainday.Sun from trainclassdetail,train,trainday,trainstatus where train.Trainno=trainday.Trainno and trainstatus.Trainno=train.Trainno and trainclassdetail.Trainno=train.Trainno and Source='{$_POST['source']}' and Destination='{$_POST['destination']}'";	
//echo "<br>";
//echo $a;
		$result=mysqli_query($con,$a);
		if($result->num_rows===0) {echo "<p>PLease enter required field carefully </p>";exit(0);}		
	        
		?>		
		<table style="width:100%">
		<tr>
		       <th>Trainno</th>
	               <th>Train name</th>		
    		       <th>M</th>
 		       <th>T</th>
   		       <th>W</th>   		       
			<th>T</th>
   		       <th>F</th>
   		       <th>S</th>
			<th>S</th>
			<th>Sl</th>
			<th>AC3</th>

		</tr> 
		<?php		
		while($row = mysqli_fetch_array($result)) 
		{ 			
		?>		
		<tr>		     
			
		      <td> <a href="http://localhost/railway/traindetail.php?train=<?php echo $row['Trainno']?>"><?php echo $row['Trainno'];?> </a>  </td>
			<td> <font size="2"> <?php echo $row['Train_name'];?> </font></td>

			<td><?php echo $row['Mon'];?> </td>
			<td> <?php echo $row['Tue'];?> </td>
		       <td><?php echo $row['Wed'];?> </td>
			<td><?php echo $row['Thu'];?> </td>
			<td> <?php echo $row['Fri'];?> </td>
		       <td><?php echo $row['Sat'];?> </td>
			<td><?php echo $row['Sun'];?> </td>
			<?php 
			if($row['AC3']==0)
			{$row['b']="N.A";}
			else if($row['b']==0)
			{$row['b']="W-{$row['d']}";
			 $row['b']++;	
			}
			else
			{$row['b']="A-{$row['b']}";}

			if($row['Sleeper']==0)
			{$row['a']="N.A";}
			else if($row['a']==0)
			{$row['a']="W-{$row['c']}";
			 $row['a']++;	
			}
			else
			{$row['a']="A-{$row['a']}";}
			 ?>				

<?php
$c=$row['Trainno'];
$d=$row['Type'];
?>


			<td><?php echo $row['a'];echo "<br>";if($row['a']!="N.A")
			 {?> <a href="http://localhost/railway/bookticket1.php?train=<?php 
			 echo $c ?>&class=Sleeper&type=<?php echo $d ?>"><font size="2">Book</font> </a> <?php } ?> </td>
			<td><?php echo $row['b'];echo "<br>";if($row['b']!="N.A")
			 {?> <a href="http://localhost/railway/bookticket1.php?train=<?php 
			 echo $c ?>&class=AC3&type=<?php echo $d ?>"><font size="2">Book</font> </a> <?php } ?> </td>
		</tr>
	       <?php       
		}
		?>		
		</table>	
	       <?php       
		}
		?>		
<h3> Abberavation :</h3>
<p> <font size="2"> N.A  -> NOT AVAILABLE CLASS <br> 
		Sl  -> SLEEPER CLASS <br>	
		AC3  -> AC3 TIER CLASS

</font></p>
	

</p>
</div>
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
