<?php
include('sliderPages.php');
require("../db.php");
session_start();
if (!isset($_SESSION['username'])) {
  header("location:login.php");

}
$class = "";
$msg ="";
$aria_label="";
$xlink="";
$cno = $_GET['cno'];
$numCNO = 0 ;
$qtyCart = 0;
$s = "select * from parts";
$r = mysqli_query($conn,$s);
if (isset($_POST['find'])) {
    $key= $_POST['key'];
    if (strlen($key) == 0) {
        $s = "select * from parts";
        $r = mysqli_query($conn,$s);
    }
    else{
        $s = "select * from parts where pname LIKE '%$key%'";
        $r = mysqli_query($conn,$s);
    }

}
if (isset($_POST['addtocart'])) {
  

    $arr=array();
    $arr=count($_POST['qty']);
    for($i=0;$i<$arr;$i++)
    {
        $row = mysqli_fetch_assoc($r);

      
       $Pid=$row['pno'];
       $Qinput = $_POST['qty'][$i];
       $sql1= "select * from parts WHERE pno=$Pid";
       $result = mysqli_query($conn,$sql1);        
        $row = mysqli_fetch_assoc($result);
        $qtytable = $row['qoh'];
       if ($Qinput > 0 && $Qinput <= $qtytable) {

         $sqlCart = "select count(distinct cno) as numCNO , qty  from cart where cno = $cno and pno =$Pid ";
         $resultCart = mysqli_query($conn,$sqlCart);        
         while ($rowCart = mysqli_fetch_assoc($resultCart)) {
                 $numCNO = $rowCart['numCNO'];
                 $qtyCart = $rowCart['qty'];
         }
           if ($numCNO == 0) {
            
            $sql = "
            INSERT Into cart (cno	,pno ,qty) VALUES ($cno,$Pid,$Qinput)";
            $rr = mysqli_query($conn,$sql);
           
           
            $date = date("Y-m-d  h:i:s");
            $_SESSION['Firstreceived'] = $date;
        
           }
           elseif ($numCNO >= 1) {
            $_SESSION['received'] = $_SESSION['Firstreceived'] ;
            $sql = "
            update cart set qty = ( $qtyCart+$Qinput ) where cno = $cno and pno =$Pid;";
            $rr = mysqli_query($conn,$sql);
           }
          echo '<style>#x{visibility: visible !important;}</style>';
          $GLOBALS['class'] = "alert alert-success d-flex align-items-center";
      $GLOBALS['msg'] = 'Successful Addition';
      $GLOBALS['aria_label'] = 'Success:';
      $GLOBALS['xlink'] = '#check-circle-fill';

        

       }
       elseif($Qinput < 0 || $Qinput > $qtytable){
        echo '<style>#x{visibility: visible !important;}</style>';
        $GLOBALS['class'] = "alert alert-danger d-flex align-items-center";
        $GLOBALS['msg']= 'select quntity less than '.$qtytable;
        $GLOBALS['aria_label'] = 'Danger:';
        $GLOBALS['xlink'] = '#exclamation-triangle-fill';

       }
       
    }

}

?>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping System</title>
    <link rel="icon" href="../img/logo.jpg">
    
    
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

   
    <link rel="stylesheet" href="../css/style.css">
    <style>


#myInput {
    background-image: url(/css/searchicon.png);
    background-position: 10px 10px;
    background-repeat: no-repeat;
    width: 45%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
</head>
<body>
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
<div class="container" style="    margin-left: 25%;
    text-align: center;
    margin-top: 12%;">
    <form action="" method ="post">
<h3 style="    text-align: initial;
    font-size: 19px;
    padding-top: 24px;">Search by KeyWord :</h3>
<div class="form-group form-button" >
                       
<input type="text" id="myInput" name="key" style="    display: inline;" placeholder="Search for names.." >
<input type="submit" name="find" value="Find"  class="form-submit" /> 
 </div>

    
<table class="table"  id="myTable">
<thead class="table-secondary">
    <tr>
      <th scope="col">PNO</th>
      <th scope="col">PNAME</th>
      <th scope="col">PRICE</th>
      <th scope="col">QTY</th>

      
    </tr>
  </thead>
  <tbody>
  <?php
  
      while ($row = mysqli_fetch_assoc($r)) {
      ?>
    <tr>
      <th scope="row">
      <?php echo $row['pno'] ?>
      </th>
      <td><?php echo $row['pname'] ?></td>
      <td>
      <?php echo $row['price'] ?>
      </td>
      <td style="width: 20%;">
      <input type="number" id=" <?php echo $row['pno'] ?>" name="qty[]">

      </td>
    </tr>
  <?php } ?>


  </tbody>
  
</table>
<div class="<?php echo isset($class)?$class:'';?>" id="x" role="alert"   style="visibility: hidden" role="alert">
<svg class="bi flex-shrink-0 me-2" width="20" height="24" role="img" aria-label="<?php echo isset($aria_label)?$aria_label:'';?>">
                    <use xlink:href="<?php echo isset($xlink)?$xlink:'';?>"/></svg>
                    <div style="    padding-left: 4%;">
 
 <?php echo isset($msg)?$msg:'';?>
</div>
                            </div>
<div class="form-group form-button" >
                        <input type="submit" name="addtocart" value="Add to Cart" style="    margin-bottom: 2%;" class="form-submit" />
                        <input type="reset" name="submit" value = "Reset" style="    margin-bottom: 2%;" class="form-submit" />
                    </div></div>
  
</form>


<script>
  setTimeout(function(){
    document.getElementById('x').style.display = 'none';
   
  }, 1500);
</script>
</body>
</html>
