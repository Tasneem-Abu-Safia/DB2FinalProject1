<!-- محتوى المنيو بار المشترك بين كل الصفحات--->
<?php
$cno = $_GET['cno'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping System</title>
    <link rel="icon" href="../img/logo.jpg">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/slider.css">
</head>
<body>
<div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Web Shopping</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Customer Menu</p>
                <li>
                        <a href="search.php?cno=<?php echo $cno; ?>">List ALL (Search By Keyword)</a>
                    </li>
                
                   
                    <li>
                        <a href="updateProfile.php?cno=<?php echo $cno; ?>">Update Profile</a>
                    </li>
                    <li>
                        <a href="viewEditCart.php?cno=<?php echo $cno; ?>">View/Edit Cart</a>
                    </li>
                    <li>
                        <a href="CheckOrderStatus.php?cno=<?php echo $cno; ?>">Check Order Status</a>
                    </li>
                    <li>
                        <a href="CheckOut.php?cno=<?php echo $cno; ?>">CheckOut</a>
                        
                    </li>
                    <li>
                        <a href="logout.php?cno=<?php echo $cno; ?>">Logout</a>
                    </li>
                </ul>

               
            </nav>

          
            
        </div>
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>