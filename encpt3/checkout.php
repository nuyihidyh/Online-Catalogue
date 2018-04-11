<?php
  include_once 'database.php';
  include_once 'checkout_crud.php';
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Payment </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
</head><!--/head-->
<nav class="navbar navbar-default navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Women Watch Shop</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="catalogue.php">Home</a></li>
      <li><a href="sign-up.php">User Registration</a></li>
      <li><a href="cart.php">Shopping Cart</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
              <li><a href="login.php">Login</a></li>
              <li><a href=search.php></a></li>
            
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<body>
  
    
  


<div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h3>Shopping Cart</h3>
      </div>
      <table class="table table-hover table-responsive table-bordered">
      <tr>
        <th>Product</th>
        <th>Price (RM)</th>
        <th>Quantity</th>
        
        
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

        <td><?php echo $detailrow['fld_product_name']; ?></td>
        <td><?php echo $detailrow['fld_product_price']; ?></td>
        <td><?php echo $detailrow['fld_cart_quantity']; ?></td>
      </tr>
       <?php
      $grandtotal = $grandtotal + $detailrow['fld_product_price']*$detailrow['fld_cart_quantity'];
    $counter++;
  }// while
  ?>
      <tr>
      <th>TOTAL</th>
      <td colspan="2" class="text-right">RM <?php echo number_format($grandtotal,2) ?></td>
      </tr>
      
      
      </table>
    </div>
  </div>
  
    <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h3>Payment Details</h3>
      </div>
      <form action="checkout.php" method="post" class="form-horizontal">
        <input type="hidden" name="pyd" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_pay_id']; ?>">

                  <div class="form-group">
                      <input type="yourname" class="form-control" name="yourname" placeholder="Enter Your Name" />
                      </div>

                        <div class="form-group">
                        
                        <select name="bankname" class="form-control" id="bankname" required>
                        <option value ="" >Please select Bank name</option>
                          <option value="Maybank" >MAYBANK</option>
                          <option value="Cimb Bank">CIMB</option>
                          <option value="Bank Rakyat">BANK RAKYAT</option>
                          <option value="Bank Islam">BANK ISLAM</option>
                          <option value="RHB">RHB BANK</option>
                        </select>
                         </div>
                         
                      <div class="form-group">
                        <input type="text" class="form-control" name="account" placeholder="Account Number"/>
                      </div>
                        <?php
                              
                              if(isset($_GET['joined']))
                              {
                                 ?>
                                         <div class="alert alert-info">
                                              <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='receipt.php'>RECEIPT</a> here
                                         </div>
                                         <?php
                              }
                              ?>
                      <center><button type="submit" class="btn btn-primary" name="create">
                  <i class="glyphicon glyphicon-open-file"></i>&nbsp;SUBMIT
                </button></center>
                       
                      
                                          <a href="receipt.php?pyd=<?php echo $_GET['pyd']; ?>" target="_blank" role="button" class="btn btn-primary btn-lg btn-block">Generate Invoice</a>
                                        
                      </div>
      </form>
      </div>
    </div>


  
  
  

  
    <script src="js/jquery.js"></script>
  <script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>