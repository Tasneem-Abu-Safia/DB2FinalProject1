<?php
include('sliderPages.php'); // اظهار منيو على الجنب
require("../db.php"); // كونيكشن على الداتا بيز
session_start();
if (!isset($_SESSION['username'])) { // فحص هل موجود اليوزر بنفس السيشن , عمل تسجيل دخول والا بيرجعو ع صفحة لوجين
    header("location:login.php");

}
// حسب رقمه وعمل عرض للاسم في واجهة الصفحة customers تحديد اسم اليوزر من جدول 
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
