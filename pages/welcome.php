<?php
include('sliderPages.php');
require("../db.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");

}

$cno = $_GET['cno'];
$s = "select cname from customers where cno = $cno";
$select = mysqli_query($conn,$s) ;
$row = $select->fetch_assoc();
$cname = $row['cname'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        h1 {
              text-align: center;
              margin-top: 14%;
        }
        h2 {
              text-align: center;
            
        }
    </style>
</head>
<body style="    background-color: lightsteelblue;">
<h1> Hi <?php echo $cname;?></h1>
    <h2 >
    
    <br> Welcome To Web Shopping Application System</h2>
</body>
</html>
