
<?php
require("../db.php");
$class = "";
$error ="";
if (isset($_POST['submit'])) {
   
    $name= $_POST['name'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zip=$_POST['zip'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $s1 = "select cname from customers where cname = '".$name."' ";
    $s2 = "select email from customers where email = '".$email."' ";

    $r1 = mysqli_query($conn,$s1);
   
    $r2 = mysqli_query($conn,$s2);

if (mysqli_num_rows($r1) == 0) {
    if (mysqli_num_rows($r2) == 0) {
        if (strlen($zip) > 0 && strlen($zip) <= 5)  {
            if (strlen($pass) >= 9 && strlen($pass) < 15)  {
            
        
   $sql= "
    INSERT INTO customers(cname,street,city,state,zip,phone,email,password)
     VALUES ('$name','$street','$city','$state',$zip,'$phone','$email','$pass')";
     $result = mysqli_query($conn,$sql);
     
     if($result===FALSE) {
        echo '<style>#x{visibility: visible !important;}</style>';
        $class = "alert alert-danger";
        $error =  mysqli_error($conn) .'';
     }
     header('location: login.php');
    }else{
        echo '<style>#x{visibility: visible !important;}</style>';
        $class = "alert alert-danger";
        $error = "password should be 9 to 15";
    }
    }else{

        echo '<style>#x{visibility: visible !important;}</style>';
        $class = "alert alert-danger";
        $error = "zip should be less than 5";
    
    }
    }
else{
    echo '<style>#x{visibility: visible !important;}</style>';
    $class = "alert alert-danger";
    $error = "Email already used , select another email";

}
}
else{
    echo '<style>#x{visibility: visible !important;}</style>';
    $class = "alert alert-danger";
    $error = "Name already used , select another name";
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

<section class="signup">
    <div class="container">
    <h4 class="title" style="text-align: center;
    padding-top: 5%;
    color: #4292DC;">Welcom to The Web Shopping Application System </h4>
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" action ="" >
                <div class="form-group">
                <div class="<?php echo isset($class)?$class:'';?>" id="x"  style="visibility: hidden" role="alert">
                            <?php echo isset($error)?$error:'';?>

                            </div></div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" required id="name" autocomplete="off" placeholder="Your Name"/>
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email"required  autocomplete="off" placeholder="Your Email"/>
                    </div>


                    <div class="form-group">
                        <label for="street"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="street"required  autocomplete="off" placeholder="Your street"/>
                    </div>
                    <div class="form-group">
                        <label for="city"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="city"required  autocomplete="off" placeholder="Your city"/>
                    </div>
                    <div class="form-group">
                        <label for="state"><i class="zmdi zmdi-home"></i></label>
                        <input type="text" name="state"required  autocomplete="off" placeholder="Your state"/>
                    </div>
                    <div class="form-group">
                        <label for="zip"><i class="zmdi zmdi-dialpad"></i></label>
                        <input type="number" name="zip"required  autocomplete="off" maxlength="5" placeholder="Your zip "/>
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="tel" name="phone" required  autocomplete="off"  pattern="^\d{3}-\d{3}-\d{4}$" placeholder="xxx-xxx-xxxx"/>
                    </div>



                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" required  autocomplete="off" placeholder="Password"/>
                    </div>
               
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" required class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                  


                   
                    <div class="form-group form-button">
                        <input type="submit" name="submit" value="Send"  class="form-submit" />
                        <input type="reset" name="submit" value = "Reset" class="form-submit" />
                    </div>
                    <div class="form-group form-button">
                    
                        
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure style="    margin-top: 40%;"><img src="../img/signup-image.jpg" alt="sing up image"></figure>
                <a href="login.php" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>
</div>
    <script src="js/main.js"></script>
</body>
</html>