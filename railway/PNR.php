<!DOCTYPE html>
<html>

<head>
<style>
table, th, td {
    border: 1px solid white;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    color:white;
}

</style>
<link href="trainenquiry.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
<div id="header">
</div>

<div id="main">

<?php 

	$con = mysqli_connect("localhost","root","amit","railway");
	session_start();
?>
<h1>
PNR STATUS:
</h1>
<?php
$a="select * from train,ticket where train.Trainno=ticket.Trainno and ticket.PNR={$_SESSION['pnr']}";
$result=mysqli_query($con,$a);
$row = mysqli_fetch_array($result);


	$pnr=$row['PNR'];
	$date=$row['Date'];
	$no=$row['No_Passenger'];
	$fare=$row['Fare'];
	$agent=$row['Bookedby'];
	$trainno=$row['Trainno'];
	$times=$row['Time_Source'];
	$timed=$row['Time_Destination'];
	$source=$row['Source'];
	$destination=$row['Destination'];
	$trainname=$row['Train_name'];
	$time=$row['Time_Taken'];
	$class=$row['Class'];
?>	
<table style="width:100%">
<p>
		<tr>
			<th>PNR No.</th> 		       
			<th>Trainno</th>
	               <th>Train name</th>		
    		       <th>Date</th>
 		       <th>Class</th>
   		        <th>Fare</th> 		       	    
		</tr> 
		<tr>		     
			<td> <font size="3"> <?php echo $pnr;?> </font></td>			
		        <td> <font size="3"><?php echo $trainno;?></font></td>
			<td> <font size="3"> <?php echo $trainname;?> </font></td>
			<td> <font size="3"> <?php echo $date;?> </font></td>
			<td> <font size="3"> <?php echo $class;?> </font></td>
			<td> <font size="3"> <?php echo $fare;?> </font></td>
			
		</tr>
		<tr>
		       <th>Boarding Station</th>
 		       <th>Leaving Station</th>   		       
			<th>Arrival Time</th>
	               <th>Departure Time</th>		
    		       	<th>Time Taken</th>		
			<th>Booked By</th>
		
		</tr> 
		<tr>
			<td> <font size="3"> <?php echo $source;?> </font></td>
			<td> <font size="3"> <?php echo $destination;?> </font></td>
			<td> <font size="3"> <?php echo $times;?> </font></td>
			<td> <font size="3"> <?php echo $timed;?> </font></td>
			<td> <font size="3"> <?php echo $time;?> </font></td>			

		</tr>
</p>	</table>

<?php

$a="select * from passengerdetail where PNR={$_SESSION['pnr']}";
$result=mysqli_query($con,$a);
$i=0;
while($row = mysqli_fetch_array($result))
{
$i++;

?>

<table style="width:100%">
<p>
		<tr>
			<th>S.no</th>		      
			 <th>Passenger name</th>
	               <th>Age</th>		
    		       <th>Gender</th>
 		       <th>Status</th>
			<th>Berth no.</th>  		      
		</tr> 
	
		<tr>
			<td> <font size="3"> <?php echo $i;?> </font></td>
			<td> <font size="3"> <?php echo $row['Name'];?> </font></td>
			<td> <font size="3"> <?php echo $row['Age'];?> </font></td>
			<td> <font size="3"> <?php echo $row['Gender'];?> </font></td>
			<td> <font size="3"> <?php echo $row['Current_Mode'];?> </font></td>
			<td> <font size="3"> <?php echo $row['Current_Status'];?> </font></td>		
		</tr>
<?php
	}
?>
</p></table>

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


