<?php
include('sliderPages.php');
require("../db.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");

}
//عرض من جدول اوردر حالة الاوردر لليوزر ووقتها 
$cno = $_GET['cno'];
$s = "select * from orders where cno = $cno";
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
<div class="container" style="    margin-left: 25%;
    text-align: center;
    margin-top: 12%;">
    
<table class="table">
  <thead class="table-secondary">
    <tr>
      <th scope="col">ONO</th>
      <th scope="col">Received</th>
      <th scope="col">Shipped</th>
      
    </tr>
  </thead>
  <tbody>
      <?php
      while ($row = mysqli_fetch_assoc($r)) {
      ?>
    <tr>
      <th scope="row">
        <!--في حالة الضفط على رقم الاوردر يظهرلو بيناتات ومحتويات الاوردر --->
       <a href="odetails.php?ono=<?php echo $row['ono']; ?>&cno=<?php echo $cno; ?>"> 
       <?php echo $row['ono'] ?> 
      </a>
      </th>
      <td><?php echo $row['received'] ?></td>
      <td><?php 
      if ($row['shipped'] == '0000-00-00 00:00:00') {
        echo 'Not Yet Shipped';
      }
      else{
      echo $row['shipped'];
       }?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
</body>
</html>