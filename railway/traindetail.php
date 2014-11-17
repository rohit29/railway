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
}</style>
<link href="trainenquiry.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
<div id="header">
</div>

<div id="main">

<?php 

$con = mysqli_connect("localhost","root","rohit","railway");
?>
<h1>
TRAIN DETAIL:
</h1>
<?php
$a="select * from train,trainday,trainclassdetail where train.Trainno=trainday.Trainno and train.Trainno={$_GET['train']}";
$result=mysqli_query($con,$a);
$row = mysqli_fetch_array($result);


	$trainno=$row['Trainno'];
	$times=$row['Time_Source'];
	$timed=$row['Time_Destination'];
	$source=$row['Source'];
	$destination=$row['Destination'];
	$trainname=$row['Train_name'];
	$time=$row['Time_Taken'];
?>	
<table style="width:100%">
<p>
		<tr>
					       
			<th>Trainno</th>
	               <th>Train name</th>		
    		       <th>Sleeper Seats</th>
 		       <th>AC3 Seats</th>
   		       <th>Boarding Station</th>
 		       <th>Leaving Station</th>   		       
			<th>Arrival Time</th>
	               <th>Departure Time</th>		
    		       	<th>Time Taken</th>		
			  		       	    
	

    		       <th>M</th>
 		       <th>T</th>
   		       <th>W</th>   		       
			<th>T</th>
   		       <th>F</th>
   		       <th>S</th>
			<th>S</th>

		</tr> 
		<tr>		     
						
		        <td> <font size="3"><?php echo $trainno;?></font></td>
			<td> <font size="3"> <?php echo $trainname;?> </font></td>
			
			<td> <font size="3"> <?php echo $row['Sleeper'];?> </font></td>
			<td> <font size="3"> <?php echo $row['AC3'];?> </font></td>
			<td> <font size="3"> <?php echo $source;?> </font></td>
			<td> <font size="3"> <?php echo $destination;?> </font></td>
			<td> <font size="3"> <?php echo $times;?> </font></td>
			<td> <font size="3"> <?php echo $timed;?> </font></td>
			<td> <font size="3"> <?php echo $time;?> </font></td>			
			


			<td><?php echo $row['Mon'];?> </td>
			<td> <?php echo $row['Tue'];?> </td>
		       <td><?php echo $row['Wed'];?> </td>
			<td><?php echo $row['Thu'];?> </td>
			<td> <?php echo $row['Fri'];?> </td>
		       <td><?php echo $row['Sat'];?> </td>
			<td><?php echo $row['Sun'];?> </td>
		</tr>


		</p>	</table>

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


