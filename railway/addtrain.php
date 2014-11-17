<!DOCTYPE html>
<html>

<head>
<link href="addtrain.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="wrapper">
<div id="header">
    </div>

<div id="section">
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
<div id="box">
<form method ="POST" action ="add.php">
<strong align="center">Train No.*</strong> <br><input type="int" required="required" name="tno" ><br>
<strong align="center">Train Name*</strong> <br><input type="text" required="required"  name="tname" ><br>
<strong align="center">Source*</strong> <br> <select name="source" required="required" >
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
</select> <br>
<strong align="center">Destination*</strong> <br> <select name="destination" required="required">
        <?php
        for($a=0;$a<sizeof($station);$a++){
        echo "<option value= '$station[$a]'>"."$station[$a]"."<br>"."</option>";
        } 
        ?>
</select> <br>
<strong align="center">Type</strong> <br> <select name="type" required="required">
        <option value="EXPRESS"> Express</option>
        <option value="SUPERFAST">Superfast</option>
</select> <br>
<strong align="center">Time Source</strong> <br> <input type="time" required="required" name="tso" ><br>
<strong align="center">Time Destination</strong> <br> <input type="time" required="required" name="tde" ><br>
<strong align="center">No of AC3 Seats</strong> <br> :<input type="int" required="required" name="ac" ><br>
<strong align="center">No of Sleeper Class Seats</strong> <br> <input type="int " required="required" name="sl" ><br>
<strong align="center">Days</strong> <br> <br>Monday<input type ="radio" name="mon"  value ="y"><br>
        Tuesday<input type ="radio" name="tue" value ="y"><br>
        Wednesday<input type ="radio" name="wed" value ="y"><br>
        Thursday<input type ="radio" name="thu" value ="y"><br>
        Friday<input type ="radio" name="fri" value ="y"><br>
        Saturday<input type ="radio" name="sat" value ="y"><br>
        Sunday<input type ="radio" name="sun" value ="y"><br>
<input type ="submit" value="add"></form></div>
<?php
    
    if($con){
    if(isset($_POST['tno']))
    {
        $sql1 ="insert into train (Trainno,Train_name,Source,Destination,Type,Time_Source,Time_Destination,Time_Taken)  
        values ('$_POST[tno]','$_POST[tname]','$_POST[source]','$_POST[destination]','$_POST[type]','$_POST[tso]','$_POST[tde]','$_POST[tt]')"; 
        
        if(mysqli_query($con,$sql1))
            {
                echo "train successfully added<br>";    
            }
        else
            echo "error".mysqli_error();
        $sql1 ="insert into trainclassdetail (Trainno,Sleeper,AC3)  
        values ('$_POST[tno]','$_POST[sl]','$_POST[ac]')";
        if(mysqli_query($con,$sql1))
            {
                echo "train successfully added<br>";    
            }
        else
            echo "error".mysqli_error();
        if(isset($_POST['mon']))
            $mon='Y';
        else
            $mon='N';
                if(isset($_POST['tue']))
            $tue='Y';
        else
            $tue='N';
                if(isset($_POST['wed']))
            $wed='Y';
        else
            $wed='N';
                if(isset($_POST['thu']))
            $thu='Y';
        else
            $thu='N';
                if(isset($_POST['fri']))
            $fri='Y';
        else
            $fri='N';
                if(isset($_POST['sat']))
            $sat='Y';
        else
            $sat='N';
                    if(isset($_POST['sun']))
            $sun='Y';
        else
            $sun='N';
        $sql1 ="insert into trainday (Trainno,Mon,Tue,Wed,Thu,Fri,Sat,Sun)  
        values ('$_POST[tno]','$mon','$tue','$wed','$thu','$fri','$sat','$sun')";
        if(mysqli_query($con,$sql1))
            {
                echo "train successfully added<br>";    
            }
        else
            echo "error".mysqli_error();


    }
}
else
    echo "failed connection ".mysqli_connet_error();

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
