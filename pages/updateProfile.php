<?php
include('sliderPages.php');
require("../db.php");

$class = "";
$msg ="";
$pass = "";
$aria_label="";
$xlink="";

session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");

}
// عرض بيانات اليوزر حسب الموجود في الجدول
$cno = $_GET['cno'];
  $s = "select * from customers where cno = $cno";
  $r = mysqli_query($conn,$s);

while ($row = mysqli_fetch_assoc($r)) {
    $name= $row['cname'];
    $street=$row['street'];
    $city=$row['city'];
    $state=$row['state'];
    $zip=$row['zip'];
    $phone=$row['phone'];
    $email=$row['email'];
    $GLOBALS['pass']=$row['password'];
 
}
///////////////////////
// ياخذ قيمة الموجود في الانبت ويعمل تعديل على الجدول بعد فحص قيمة باسوورد متوافق ام لا مع الموجود
if (isset($_POST['submit'])) {
   
    $name= $_POST['name'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zip=$_POST['zip'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $oldpass=$_POST['oldpass'];
    $newpass=$_POST['newpass'];
    // يقارن الباسوورد القديم مع الجدول لاتمام عملية التعديل وفي حال ادخل باسوورد جديد بيفحص القديم والجديد اكبر من 9
    if (strcmp($GLOBALS['pass'], $oldpass) == 0   ) {
        if (strlen($newpass) >= 9) {
            $oldpass = $newpass;
        }
        else{
            $GLOBALS['msg'] = "check new password";
        }
      
   $sql= " update customers set cname = '$name' , street = '$street' ,city = '$city',
   state = '$state',zip = $zip,phone = '$phone',email='$email', password = '$oldpass'
    where cno = $cno ;";
     $result = mysqli_query($conn,$sql);
     echo '<style>#x{visibility: visible !important;}</style>';
     $GLOBALS['class'] = "alert alert-success d-flex align-items-center";
      $GLOBALS['msg'] = 'Successful Addition';
      $GLOBALS['aria_label'] = 'Success:';
      $GLOBALS['xlink'] = '#check-circle-fill';

     if($result===FALSE) {
      echo $GLOBALS['msg']=  mysqli_error($conn) .'';
     }

     
}
else{
    echo '<style>#x{visibility: visible !important;}</style>';
    $GLOBALS['class'] = "alert alert-danger  d-flex align-items-center";
    $GLOBALS['msg']= 'check your  password';
    $GLOBALS['aria_label'] = 'Danger:';
    $GLOBALS['xlink'] = '#exclamation-triangle-fill';

}
      } 
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
  
</style>
</head>
<body>
<div class="main">


    <div class="container" style="  background: #23607c ; width: 50%;
    margin-left: 30%;">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
        <div class="signup-content" >
            <div class="signup-form">
                <h2 class="form-title">Update Profile</h2>
                <form method="POST" action ="" >
                <div class="<?php echo isset($class)?$class:'';?>" id="x" role="alert" style="visibility: hidden" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="20" height="24" role="img" aria-label="<?php echo isset($aria_label)?$aria_label:'';?>">
                    <use xlink:href="<?php echo isset($xlink)?$xlink:'';?>"/></svg>
                    <div style="    padding-left: 4%;">
 
                            <?php echo isset($msg)?$msg:'';?>
 </div>
                            </div>
                   
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" required id="name" value ="<?php echo $name ;?>" autocomplete="off" placeholder="Your Name"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email"required  autocomplete="off" value ="<?php echo $email ;?>" placeholder="Your Email"/>
                    </div>


                    <div class="form-group">
                        <label for="street"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="street"required  autocomplete="off" value ="<?php echo $street ;?>" placeholder="Your street"/>
                    </div>
                    <div class="form-group">
                        <label for="city"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="city"required  autocomplete="off" value ="<?php echo $city ;?>" placeholder="Your city"/>
                    </div>
                    <div class="form-group">
                        <label for="state"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="state"required  autocomplete="off" value ="<?php echo $state ;?>" placeholder="Your state"/>
                    </div>
                    <div class="form-group">
                        <label for="zip"><i class="zmdi zmdi-dialpad"></i></label>
                        <input type="number" name="zip"required  autocomplete="off" maxlength="5" value ="<?php echo $zip ;?>" placeholder="Your zip "/>
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="tel" name="phone" required  autocomplete="off" value ="<?php echo $phone ;?>" pattern="^\d{3}-\d{3}-\d{4}$" placeholder="xxx-xxx-xxxx"/>
                    </div>


                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="oldpass" required  autocomplete="off"  placeholder="Old Password"/>
                    </div>
               
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="newpass"   autocomplete="off"  placeholder="NEW Password >= 9"/>
                    </div>
               
               
                  


                    <div class="form-group form-button">
                        <input type="submit" name="submit"   class="form-submit" value ="Update" />
                    </div>
                   
                </form>
            </div>
          
        
    </div>
</section>
</div>
<script>
  setTimeout(function(){
    document.getElementById('x').style.display = 'none';
   
  }, 1500);</body>
</html>