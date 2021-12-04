<?php
include('sliderPages.php');
require("../db.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

$cno = $_GET['cno'];
$class = "";
$msg ="";
$aria_label="";
$xlink="";
$total_cost = 0;
//عند الضغط على هذه الصفحة لعرض الفاتورة يفحص هل يوجد لليوزر طلبات في جدول الكارت ام لا 
// اذا ما كان في اوردر يعرض صفحة الفيديوز كلها حتى يختار اما اذا كان في اوردر يحسب الفاتورة الها
$sqlstart ="select count(cartno) as numINcart from cart where cno = $cno";
$resstart=mysqli_query($conn,$sqlstart);
$rowstart = $resstart->fetch_assoc();
$count_cart = $rowstart['numINcart'];
if ($count_cart != 0) {

//نعرض بيانات الفاتورة من الكارت قبل ما يفرغها
$sql = "
SELECT parts.pno ,parts.pname,parts.price , sum(cart.qty) as quntity
FROM cart INNER JOIN parts ON (cart.pno = parts.pno and cart.cno = $cno )
group by parts.pname
order by cart.pno;
";
$result = mysqli_query($conn,$sql);
$s = "select * from parts";
$r = mysqli_query($conn,$s); // نعرضهم في جدول تحت

/////////////////
//يضيف على جدول الاوردر مرة واحدة للمشتري مع وقت البيع
$_SESSION['ShippedDate'] = date("Y-m-d  h:i:s");
$R_date = "";
if (isset($_SESSION['Firstreceived'])) {
  $R_date = $_SESSION['Firstreceived'];
}
elseif(isset($_SESSION['received'])){
  $R_date = $_SESSION['received'];
}

  $sOrders = "
  INSERT Into orders (cno,received,shipped) Values ($cno,'$R_date','$_SESSION[ShippedDate]')";
  $rOrders = mysqli_query($conn,$sOrders);
//////////////////////

//odetails هنا من جدول الاوردر يحدد رقم الاوردر الخاص باليوزر سواء للطباعة بالفاتورة او للتخزين بجدول 
$sql3 ="select ono from orders where cno = $cno  ORDER BY ono DESC LIMIT 1";
$res3=mysqli_query($conn,$sql3);
$row3 = $res3->fetch_assoc();
$ono = $row3['ono'];
/////////////////////

// هنا يعدل كمية الفديوز الاصلية يطرح منها عدد المطلوب
$sCart = "select pno , qty from cart where cno = $cno ";
$rCart = mysqli_query($conn,$sCart);
$pnoCart = "";
$qtyCart = "";
while ($rows = mysqli_fetch_assoc($rCart)) {
$GLOBALS['pnoCart'] = $rows['pno'];
$GLOBALS['qtyCart'] = $rows['qty'];
$sql4 ="update parts set qoh = (qoh-$GLOBALS[qtyCart]) where pno = $GLOBALS[pnoCart]";
$res4=mysqli_query($conn,$sql4);

// odetails الاضافة على جدول 
$sOdetails = "
INSERT Into odetails (ono ,pno , qty) Values ($ono , $pnoCart , $qtyCart)";
$rOdetails = mysqli_query($conn,$sOdetails);
}
////////////////////// حذف الكارد بالاخر












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
#or{
    text-align: center;
    font-size: 19px;
    padding-top: 24px;
}
</style>
</head>
<body>

<div class="container" style="        padding-bottom: 2%;margin-left: 25%;margin-bottom: 10%;text-align: center;margin-top: 8%;">
  
<h3 id="or">Invoice For  <?php
$c = "select * from customers where cno = $cno";
$rc = mysqli_query($conn,$c);
$canme = "";
$address = "";
while ($rows = mysqli_fetch_assoc($rc)) {
    $canme = $rows['cname'];
    $address = ''.$rows['street'].' - '. $rows['city'].' - '.
    $rows['state'].' - '.$rows['zip'];
}
echo $canme;
?></h3>
<h3 id="or">Shipping Address : <?php echo $address; ?></h3>
<h3 id="or">Order Number : <?php echo $ono;?></h3>


    
<table class="table"  id="myTable">
<thead class="table-secondary">
    <tr>
      <th scope="col">PNO</th>
      <th scope="col">PNAME</th>
      <th scope="col">PRICE</th>
      <th scope="col">QTY</th>
      <th scope="col">Cost</th>


      
    </tr>
    
  </thead>
  <tbody>
 <?php
  
      while ($row = mysqli_fetch_assoc($result)) {
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
      <input type="text" id=" <?php echo $row['pno'] ?>" name="qty[]" readonly value = " <?php echo $row['quntity'] ?>">
      </td>
      <td>
      <?php 
      $DVDprice = $row['quntity'] * $row['price'];
     $GLOBALS['total_cost'] += $DVDprice;
      echo $DVDprice ;?>
      </td>
    </tr>


    <?php } ?>
  </tbody>
  <tfoot>
      <tr>
          <th colspan="4" style="    text-align: end;">Total Cost : </th>
          <th style="text-align = center;">
        <?php echo $GLOBALS['total_cost']; ?>
        </th>

      </tr>
  </tfoot>
   
</table>
<div>
    Please print a copy of the invoice for your records
</div>
<?php
// حذف محتوى الكارت
 $sql2 ="delete from cart where cno = $cno ";
 $result2 = mysqli_query($conn,$sql2);   
      }
      else {
        header("location:search.php?cno=$cno");
      }
?>

</body>
</html>
