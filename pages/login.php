<?php
session_start();
require("../db.php");
$class = "";
$error ="";
/* 
  في حال ضفط على بوتون لوجن بياخد الايميل وكلمة السر من الفورم
  يتاكد من بيانات اليوزر بعمل سيليكت على جدول اليوزر حسب الايميل في حال وجدو يفحص كلمة السر صحيحة ام لا
  وينشأ سيشين وكوكيز الهم 
  ويروح على صفحة الرئيسية
Invalid Email or Password  عدا ذلك يظهر رسالة  
Create an account في حالة اختيار 
يذهب لصفحة انشاء حساب جديد
*/
if (isset($_POST['signin'])) {
    $email = $_POST['your_email'];
    $password = $_POST['your_pass'];
    $cno = "";
    $sql= $conn->prepare("select * from customers where email = ? ");
    $sql->bind_param("s",$email);
    $sql->execute();
    $sql_result = $sql->get_result();
    if ($sql_result->num_rows > 0) {
        $data = $sql_result->fetch_assoc();
          if ($data['password'] === $password) {
              $cno = $data['cno'];
              $_SESSION['username'] =  $email ;
              $_SESSION['password'] = $password;
              setcookie('email',$_POST['your_email'],time()+3600+"/");
              setcookie('password',$_POST['password'],time()+3600+"/");
              header("location:welcome.php?cno=$cno");

          }
          else {
                 
    echo '<style>#x{visibility: visible !important;}</style>';
    $class = "alert alert-danger";
    $error = "Invalid Email or Password";
          }
    }else {
           
    echo '<style>#x{visibility: visible !important;}</style>';
    $class = "alert alert-danger";
    $error = "Invalid Email or Password";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<div class="main">

<section class="sign-in">
            <div class="container">
            <h4 class="title" style="text-align: center;
    padding-top: 5%;
    color: #4292DC;">Welcom to The Web Shopping Application System </h4>

                <div class="signin-content">
                    
                    <div class="signin-image">
                        <figure><img src="../img/signin-image.jpg" alt="sing up image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" required name="your_email" id="your_email" placeholder="Your email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" required name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="<?php echo isset($class)?$class:'';?>" id="x"  style="visibility: hidden" role="alert">
                            <?php echo isset($error)?$error:'';?>

                            </div>
                            <div class="form-group form-button">
                                <input type="submit"  name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="https://www.facebook.com"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="https://twitter.com"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://mail.google.com"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
</body>
</html>