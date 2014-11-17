<!DOCTYPE html>
<html>

<head><link href="trainenquiry.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="wrapper">
<div id="header">
</div>

<div id="main">
<div id="box1">
   <form name ="user"     method ="POST" action ="addstation.php">
    <strong align="center">Station Name</strong> <br> <input   type="text"   size="15" name ="sname" ><br>
    <strong align="center">Station ID</strong> <br> <input  type ="int "  size="15" name ="sno"><br>
    <input type ="submit" class="form-control" value="Add">
    </form></div>
<?php 
    $con    =    mysqli_connect("localhost","root","rohit","railway");
    if($con){
    if(isset($_POST['sname']))
    {
        $sql1   =   "insert into station (sname,sno) values ('$_POST[sname]','$_POST[sno]')";
        if(mysqli_query($con,$sql1))
            echo "<h2>Station has been added</h2><br>";
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

