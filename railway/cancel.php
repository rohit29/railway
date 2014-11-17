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
	$con = mysqli_connect("localhost","root","rohit","railway");
	$a="select * from ticket where PNR={$_POST['pnr']}";
	$result=mysqli_query($con,$a);	
	$row = mysqli_fetch_array($result); 
	$date=$row['Date'];
	$train=$row['Trainno'];
	$number=$row['No_Passenger'];	
	$class=$row['Class'];	
	echo $date;
	echo $train;
	echo $number;
	echo $class;	


for($i=0;$i<$number;$i++)
	{
		$b="select * from passengerdetail where PNR={$_POST['pnr']}";
		$resultb=mysqli_query($con,$b);	
		$rowb = mysqli_fetch_array($resultb); 
		$cstat=$rowb['Current_Status'];
		echo "out";
		echo $cstat;
		$cmode=$rowb['Current_Mode'];		
		$name=$rowb['Name'];		
		$bb="delete from passengerdetail where Name='{$name}' and PNR={$_POST['pnr']}"; 
	
		if ($con->query($bb) === TRUE) 
		{
			echo "deleted one from passengerdetail";echo "<br>";		
		} 
		else {
		    echo "not deleted one from passengerdetail";echo "<br>";
		}

		$c="select * from passengerdetail,ticket where passengerdetail.PNR=ticket.PNR and ticket.Trainno={$train} and ticket.Date='{$date}' and ticket.Class='{$class}'";
		$resultc=mysqli_query($con,$c);	
		
		$pa="select * from trainstatus where Date='{$date}' and Trainno={$train}";
		$resultpa=mysqli_query($con,$pa);		
		$rowpa=mysqli_fetch_array($resultpa);
		if($class=='Sleeper')
		{
			$avaseat=$rowpa['Waiting_Sleeper'];
		}
		else
		{
			$avaseat=$rowpa['Waiting_AC3'];
		}
		echo "avaseat=";echo $avaseat;echo "done"; 
		while($rowc = mysqli_fetch_array($resultc)) 		
		{	
			$cpnr=$rowc['PNR'];
			$cname=$rowc['Name'];		
			$rstatus=$rowc['Current_Status'];
			$rmode=$rowc['Current_Mode'];			
			if($cmode=='C')
			{
				
				if($rowc['Current_Mode'] == 'W' && $rowc['Current_Status']==1)
				{	echo "inw1";
					echo $cstat;
					echo $cname;
					echo $cpnr;					
					$cc="update passengerdetail set Current_Status={$cstat},Current_Mode='C' where Name='{$cname}' and PNR={$cpnr}"; 
	
					$con->query($cc);			

				}			
				else if($avaseat==0 && $cstat > $rowc['Current_Status'] && $rowc['Current_Mode']=='C')
				{	echo "in new";	echo "$rstatus";
					$rstatus++;	
					$cc="update passengerdetail set Current_Status={$rstatus} where Name='{$cname}' and PNR={$cpnr}"; 
	
					$con->query($cc);			
			
				}	
				else //($rowc['Current_Mode'] == 'W')
				{
					echo "rstst";echo $rstatus;								
					$rstatus--;					
					if($rowc['Current_Mode']=='W')					
					{$cc="update passengerdetail set Current_Status={$rstatus} where Name='{$cname}' and PNR={$cpnr}"; 
	
					$con->query($cc);}
				}	
		       }
		       else
		       {	echo "yes1";
				//echo $rowc['Current_Mode'];
				//echo $rowc['Current_Status'];
				//echo "-";
				//echo $cstat;				
				//echo "<br>";				
					if($rowc['Current_Mode'] == 'W' && $rowc['Current_Status'] > $cstat)
				{
					echo "in pass";
					echo $rowc['Current_Status'];
					$rstatus--;					
					echo $rstatus;
					$cc="update passengerdetail set Current_Status={$rstatus} where Name='{$cname}' and PNR={$cpnr}"; 
					if($con->query($cc)===TRUE)
					{echo "updated";}
					else{echo "query not exe";}
					echo "out";
				}
				//else{echo "no";}			
					
		       }
		}
//updating trainstatus
	$ccc="select * from trainstatus where Trainno={$train} and Date='{$date}'";
		$resultccc=mysqli_query($con,$ccc);			
		$rowccc = mysqli_fetch_array($resultccc); 		
		//print_r($rowccc);

		//		$x=$rowccc['Available_Sleeper'];		
		//echo $x;
		//echo "vi";
		if($class=='Sleeper')
		{echo "in sleeper";//$x=$rowccc['Availabe_Sleeper'];
			if($rowccc['Waiting_Sleeper'] > 0)
			{
				$upwait=$rowccc['Waiting_Sleeper'];
				$upwait--;				
				$ccca="update trainstatus set Waiting_Sleeper={$upwait} where Trainno={$train} and Date='{$date}'"; 
				$con->query($ccca);	
			}
			else
			{	
				//echo $x;
				$x=$rowccc['Available_Sleeper'];
				//echo "hi";
				//echo $rowccc['Available_Sleeper'];		
				//echo "bi";
				//$rowccc['Availabe_Sleeper']++;		
				//echo $rowccc['Available_Sleeper'];				
				$x++;				
				//echo "ti";
				//echo $x;		
				
				$cccb="update trainstatus set Available_Sleeper={$x} where Trainno={$train} and Date='{$date}'"; 
				$con->query($cccb);			
			}
		}

		else
		{echo "In else";
			if($rowccc['Waiting_AC3'] > 0)
			{
				$upwait=$rowccc['Waiting_AC3'];
				$upwait--;				
				$cccd="update trainstatus set Waiting_AC3={$upwait} where Trainno={$train} and Date='{$date}'"; 
				$con->query($cccd);	
			}
			else
			{
				$upava=$rowccc['Availabe_AC3'];
				$upava++;				
				$ccce="update trainstatus set Availabe_AC3={$upava} where Trainno={$train} and Date='{$date}'"; 
				$con->query($ccce);			
			}
		}
	

	}
	$tic="delete from ticket where PNR={$_POST['pnr']}"; 
	$con->query($tic);
?>
<h2>TICKET HAS BEEN CANCELLED<h2>
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

