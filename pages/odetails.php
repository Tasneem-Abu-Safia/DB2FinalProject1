<?php
include('sliderPages.php');
require("../db.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");

}
$ono = $_GET['ono'];
$cno = $_GET['cno'];

/*عرض بيانات الاوردر من باقي الجداول 
بيانات من جدول البارت حسب رقم الفيديو 
ومن خلال جدول ديتيلز بنعرف رقم الفيديو حسب رقم الاوردر 
ويعرض الكمية من جدول ديتيلز 
لليوزر نفسو نفحص
*/
$s = "
SELECT  parts.* ,odetails.qty
FROM ((odetails
INNER JOIN orders ON (odetails.ono = orders.ono and orders.cno = $cno ))
INNER JOIN parts ON odetails.pno = parts.pno)
WHERE orders.ono = $ono;";
$r = mysqli_query($conn,$s);


?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping System</title>
    <link rel="icon" href="../img/logo.jpg">
    
    
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

   
    <link rel="stylesheet" href="../css/style.css">
    <style>
        table th:first-child{
            
  border-radius:10px 0 0 10px;
}
table th:last-child{
  border-radius:0 10px 10px 0;
}

    </style>
</head>
<body>
<div class="container" style="   width: 40%; margin-left: 36%;
    text-align: center;
    margin-top: 12%;">
    
<table class="table">
  <thead class="table-secondary">
    <tr>
    <th scope="col">Pno</th>    
     <th scope="col">Pname</th>
   
     <th scope="col">price</th>
     <th scope="col">olevel</th>
     <th scope="col">qty</th>
     <th scope="col">Total price</th>
    </tr>
  </thead>
  <tbody>
  <?php
      while ($row = mysqli_fetch_assoc($r)) {
      ?>
  <tr>  
      
        <th scope="col"><?php echo $row['pno'] ?></th>
        <th scope="col"><?php echo $row['pname'] ?></th>
        <th scope="col"><?php echo $row['price'] ?></th>
        <th scope="col"><?php echo $row['olevel'] ?></th>
        <th scope="col"><?php echo $row['qty'] ?></th>
        <th scope="col"><?php echo $row['price']*$row['qty'] ?></th>

        </tr>
  </tbody> 
  <?php } ?>
</table>
</div>
</body>
</html>


    
      
      
    
