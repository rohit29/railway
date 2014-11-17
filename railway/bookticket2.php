$a="select * from train where Trainno={$_GET['train']}";
	$result=mysqli_query($con,$a);
	$row = mysqli_fetch_array($result); 
	?>			
<h>
Your Ticket is successfully booked with following detail :
</h>

<table style="width:100%">
<p>
		<tr>
			<th>PNR No.</th> 		       
			<th>Trainno</th>
	               <th>Train name</th>		
    		       <th>Date</th>
 		       <th>Class</th>
   		         		       
			
   		    
		</tr> 
		<tr>		     
			<td> <font size="3"> <?php echo $pnr;?> </font></td>			
		      <td> <font size="3"><?php echo $_GET['train'];?></font></td>
			<td> <font size="3"> <?php echo $result['Train_name'];?> </font></td>
			<td> <font size="3"> <?php echo $_SESSION['date'];?> </font></td>
			<td> <font size="3"> <?php echo $_GET['class'];?> </font></td>
			
			
		</tr>
				<tr>
		       <th>Arrival</th>
	               <th>Departure</th>		
    		       <th>Boarding</th>
 		       <th>Leaving</th>   		       
			<th>Fare</th>
		</tr> 
		<tr>
			<td> <font size="3"> <?php echo $result['Time_Source'];?> </font></td>
			<td> <font size="3"> <?php echo $result['Time_Destination'];?> </font></td>
			<td> <font size="3"> <?php echo $result['Source'];?> </font></td>
			<td> <font size="3"> <?php echo $result['Destination'];?> </font></td>
			<td> <font size="3"> <?php echo $fare;?> </font></td>			

		</tr>
</p>	
<table style="width:100%">
	<p>
		<tr>
			<th>S.no</th>		      
			 <th>Passenger name</th>
	               <th>Age</th>		
    		       <th>Gender</th>
 		         		      
		</tr> 
	<?php
	for($i=1;$i<=$_POST['number'];$i++)
	{
	?>
	
		<tr>
			<td> <font size="3"> <?php echo $i;?> </font></td>
			<td> <font size="3"> <?php echo $_POST["name{$i}"];?> </font></td>
			<td> <font size="3"> <?php echo $_POST["age{$i}"];?> </font></td>
			<td> <font size="3"> <?php echo $_POST["gender{$i}"];?> </font></td>
			
		</tr>
	<?php
	}
	?>
</p>
<p><a href="http://localhost/railway/bookticket2.php">Confirm Ticket</a></p>


