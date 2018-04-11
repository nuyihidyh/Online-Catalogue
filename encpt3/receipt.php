<?php
  include_once 'database.php';
  require_once("cart_crud.php");
?>

<?php

  require_once("session.php");
  
  require_once("class.user.php");
  $auth_user = new USER();
  
  
  $user_id = $_SESSION['user_session'];
  
  $stmt = $auth_user->runQuery("SELECT * FROM tbl_users_a149771 WHERE user_id=:user_id");
  $stmt->execute(array(":user_id"=>$user_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
  <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_payment_a149771");

      $stmt->bindParam(':pyd', $pyd, PDO::PARAM_INT);
      $pyd = $_GET['pyd'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
   
   <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Invoice</title>
  <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
 
<div class="row">
<div class="col-xs-6 text-center">
  <br>
    <a href="#"><img src="logo.png" alt="" /></a>
</div>
<div class="col-xs-6 text-right">
  <h1>RECEIPT</h1>
</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>From: Women Watch Shop Shop Sdn. Bhd.</h4>
      </div>
      <div class="panel-body">
              <p> Women Watch Shop SDN.BHD.</p>
              <p> N0 34 UP/1</p>
              <p> Jalan Dato Haji 1</p>
              <p> 43600 Bandar Kinrara</p>
              <p> KUALA LUMPUR</p>
        </p>
      </div>
    </div>
  </div>
    <div class="col-xs-5 col-xs-offset-2 text-right">
        <div class="panel panel-default">
            <div class="panel-heading">
             <h4>&nbsp;To: <?php echo $userRow['user_name']; ?>&nbsp;</h4>

            </div>
            <div class="panel-body">
                       &nbsp; Email: <?php echo $userRow['user_email']; ?>&nbsp;</p>
                      <p>
        <br>
        <br>
        <br>
        <br>
        </p>
            </div>
        </div>
    </div>
</div>
 
<table class="table table-hover table-responsive table-bordered">
      <tr>
        <th>No</th>
        <th>Product</th>
        <th class="text-right">Price(RM)/Unit</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Total(RM)</th>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_cart_a149771, tbl_products_a149771 WHERE tbl_cart_a149771.fld_product_id = tbl_products_a149771.fld_product_id");
        $stmt->bindParam(':did', $did, PDO::PARAM_STR);
        //$did = $_GET['did'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_cart_quantity']; ?></td>
        <td class="text-right"><?php echo $detailrow['fld_product_price']*$detailrow['fld_cart_quantity']; ?></td>
      </tr>
       <?php
      $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_cart_quantity'];
    $counter++;
  } // while
  ?>
      <tr>
      <td colspan="4" class="text-right">Grand Total</td>
      <td colspan="5" class="text-right">RM <?php echo number_format($grandtotal,2) ?></td>
      </tr>
       
      
      </table>


    <div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Payment Details</h4>
      </div>
      <div class="panel-body">
        <p>Your Name : <?php echo $readrow['fld_your_name']?></p>
        <p>Bank Name : <?php echo $readrow['fld_bank_name']?></p>
        <p>Account Number : <?php echo $readrow['fld_account_no']?></p>
        
      </div>
    </div>
    </div>

  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p>Mobile: +60148873473</p>
              <p>Fax: +60328070402</p>
              <p>Email: contactus@womenwatchshop.com</p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated receipt. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>