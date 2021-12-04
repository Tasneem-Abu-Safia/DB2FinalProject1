<?php
session_start();
/*session_destroy();
setcookie("username",$email,time()-3600);
setcookie("password",$password,time()-3600);
header('location: login.php');*/

include('sliderPages.php');
require("../db.php");
if (!isset($_SESSION['username'])) {
    header("location:login.php");

}
//نحدد هل يوجد لليوزر شيء في جدول الكارت
$cno = $_GET['cno'];
$sqlCart = "select count(distinct cno) as numCNO  from cart where cno = $cno";
$result = mysqli_query($conn,$sqlCart);        
$row = mysqli_fetch_assoc($result);
$cnotable = $row['numCNO']; // نستخدمها تحت

///////////////



if (isset($_POST['submit'])) {// في حالة عمل سبمت
   if (isset($_POST['logout'])) { // يتاكد انو اختار احدى الخيارات والا يظهر ارور 
       
        $condition = $_POST['logout'];  // يحدد اي الخيارات تم اختيارها
    
       if ($condition == 'checkout') { //في حالة اراد يعمل فاتورة بيروح على صفحة الفاتورة
        header("location:CheckOut.php?cno=$cno");


    }
       elseif ($condition == 'save') {//فيحالة اراد عمل حفظ بدون حذف او حساب فاتورة بيعمل تسجيل خروج مباشرة
        session_destroy();
        setcookie("username",$email,time()-3600);
        setcookie("password",$password,time()-3600);
        header('location: login.php');

    }
       elseif ($condition == 'empty') { // في حالة اختار تفريغ للكارت بيحذفهم من جدول الكارت
        $sql ="delete from cart where cno = $cno ";
        $result = mysqli_query($conn,$sql);   
        session_destroy();
        setcookie("username",$email,time()-3600);
        setcookie("password",$password,time()-3600);
        header('location: login.php');

    }}
    else {
        echo "<script> alert('You Should select one!'); </script>" ;
    }
      


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
    <?php
    // اول حالة الكارت فارغة لليوزر ف بيعمل تسجيل خروج مباشرة
    if ($cnotable == 0) {
        session_destroy();
        setcookie("username",$email,time()-3600);
        setcookie("password",$password,time()-3600);
        header('location: login.php');
    }
    // اذا كان لليوزر قيم في الكارت يظهر عدة خيارات له شرحها فوق 
    else {
    ?>
<div class="container" style="margin-left: 10%;
    text-align: center;
    margin-top: 5%;">
    <h1>LogOut Page</h1><br><br>

    <h3>Your Shopping Cart Has Items in it! <br>
     Please choose on of the following options before logging out. </h3><br>
<form action="" method="post">
<div class="form-check">
      <input type="radio" class="form-check-input" name="logout" id="checkout" value="checkout"> <label class="form-check-label" for="checkout">CheckOut         </label><br>
      <input type="radio" class="form-check-input" name="logout" id="save" value="save"> <label class="form-check-label" for="save">Save Cart and LogOut</label><br>
      <input type="radio" class="form-check-input" name="logout" id="empty" value="empty"> <label class="form-check-label" for="empty">Empty Cart and LogOut</label><br>
     <br>
    
      <div class="z">
            <div class="inner"></div>    
          
      <button  class="btn btn-lg btn-primary" type="submit" name="submit" >Submit</button> 
      <button type="reset" name="submit" class="btn btn-lg btn-primary">Reset</button> 

        </div>  
        

</form>
</div>   

<?php
    }
?>
</body>
</html>



