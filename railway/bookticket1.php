<!DOCTYPE html>
<html>

<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
}


</style>
<link href="bookticket1.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="wrapper">
<div id="header">
        </div>

<div id="main">

<?php
session_start();
if(isset($_POST['name1']) )
{
   $con = mysqli_connect("localhost","root","amit","railway");
   if(!$con)
   {
      echo("<p>Connection to content server failed.</p>");
      exit();
   }
   else
   {

      //session_start();  
      $a="select max(PNR) as max from ticket";  
      $result=mysqli_query($con,$a);
      $row = mysqli_fetch_array($result); 
      if($row['max']==NULL)         
      {$pnr=1000000000;}
      else {$pnr=$row['max'];$pnr++;}
      // calculating fare     
      
      $a="select * from fare";
      $result=mysqli_query($con,$a);
      while($row = mysqli_fetch_array($result)) 
      {
         if(($row['Station1']==$_SESSION['source'] && $row['Station2']==$_SESSION['destination']) || ($row['Station2']==$_SESSION['source'] && $row['Station1']==$_SESSION['destination']))
         {  
            if($_GET['type']=='EXPRESS' && $_GET['class']=='Sleeper')         
            {$fare=$row['Express_Sleeper'];}
            else if($_GET['type']=='EXPRESS' && $_GET['class']=='AC3')        
            {$fare=$row['Express_AC3'];}

            if($_GET['type']=='SUPERFAST' && $_GET['class']=='Sleeper')       
            {$fare=$row['Superfast_Sleeper'];}

            if($_GET['type']=='SUPERFAST' && $_GET['class']=='AC3')        
            {$fare=$row['Superfast_AC3'];}
         }        
      


      }  
      $fare=$fare * $_SESSION['number'];
                     
              

      // feeding into passenger detail and ticket

      $a="insert into ticket values({$pnr},{$fare},{$_SESSION['number']},'amit',{$_GET['train']},
         '{$_SESSION['date']}','{$_GET['class']}')";

      if ($con->query($a) === TRUE) {
      } 
      else {
          echo "Error: Not inserted in ticket";
      }

// fetching availability

      $b="select * from trainstatus";
      $result=mysqli_query($con,$b);
      while($row = mysqli_fetch_array($result)) 
      {
         if($row['Trainno']==$_GET['train'] && $row['Date']==$_SESSION['date'])
         {
            if($_GET['class']=='Sleeper')
            {$avl=$row['Available_Sleeper'];
            $wait=$row['Waiting_Sleeper'];}
            if($_GET['class']=='AC3')
            {$avl=$row['Available_AC3'];
            $wait=$row['Waiting_AC3'];}         
            
               

         }
      }

      for($i=1;$i<=$_SESSION['number'];$i++)
      {  

         if($avl <= 0)
         {
            $bs=$wait;
            $bs++;
            $cs=$bs;
            $bm='W';
            $cm='W';
         }
         else
         {
            $bs=$avl;
            $cs=$bs;
            $bm='C';
            $cm='C';
         }

      // feeding into passenger detail
   
         $a="insert into passengerdetail values({$pnr},'{$_POST["name{$i}"]}',{$_POST["age{$i}"]},
            '{$_POST["gender{$i}"]}',{$bs},'{$bm}',{$cs},'{$cm}')";

         if ($con->query($a) === TRUE) 
         {
         // updating trainstatus
            if($avl>0)
            {
               $avl--;
            }
            else
            {
               $wait++;
            }

         } 
         else
         {
            echo "Error: Not inserted in passengerdetail";
         }

      }

      if($_GET['class']=='Sleeper')
      {
         $a="update trainstatus set Available_Sleeper={$avl},Waiting_Sleeper={$wait} where Trainno={$_GET['train']} and Date='{$_SESSION[date]}'";
         if ($con->query($a) === TRUE) 
         {
         }
         else
         {
            echo "<br>";
            echo "Not updated trainstatus";
         }
      }
      else
      {
         $a="update trainstatus set Available_AC3={$avl},Waiting_AC3={$wait} where Trainno={$_GET['train']} and Date='{$_SESSION[date]}'";

         if ($con->query($a) === TRUE) 
         {
         }  
         else
         {
            echo "<br>";
            echo "Not updated trainstatus";
         }
      }
session_start();
$_SESSION['pnr']=$pnr;
 
 }?>      
<p>Ticket Successfully Booked with PNR no = <?php echo $pnr ?></p>
<p>Total Fare = <?php echo $fare ?></p>
<p><a href="http://localhost/railway/PNR.php">See Ticket</a>
<?php
}
else
{
?>
<p>
<div id="box1">
<form name="ask" action="<?php $_PHP_SELF ?>" method="post">
No of Passenger: <input type="int" name="number"> <br>
<input type="submit" value="go"></form>
<?php if(isset($_POST['number'])){ ?>
<form name="book" action="<?php $_PHP_SELF ?>" method="post">
<?php 
    $a=1;
   $_SESSION['number']=$_POST['number'];
     while($a<=$_POST['number'])
{

echo "<p>Passnger".$a.":</p>";  
echo "Name".$a."<input type='text' name='name".$a."'>  <br>";
echo  "Age<input type='text' name='age".$a."'>  <br>";
echo  "Gender<input type='text' name='gender".$a."'>  <br>";
$a++;
}
?>
<input type="submit" value="Book">
</form></div> 
<?php
}  echo $_POST['name1']; 
?>



</p>
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

