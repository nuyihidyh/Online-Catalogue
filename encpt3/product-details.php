<?php
  include_once 'database.php';
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
    <title>Cart | WOmen Watch SHOP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    </head>
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
  
 <?php   
    
  try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a149771 WHERE fld_product_id= :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['pid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
      <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Product Details</h2>
      </div>
      </div>
      </div>
      
    <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2 well well-sm text-center">
      <?php if ($readrow['fld_product_image'] == "" ) {
        echo "No image";
      }
      else { ?>
      <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-4">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Product Details</strong></div>
      <div class="panel-body">
          Below are specifications of the product.
      </div>
      <table class="table">
          <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
          <td><?php echo $readrow['fld_product_id'] ?></td>
        </tr>
        <tr>
          <td><strong>Product Name</strong></td>
          <td><?php echo $readrow['fld_product_name'] ?></td>
        </tr>
        <tr>
          <td><strong>Product Brand</strong></td>
          <td><?php echo $readrow['fld_product_brand'] ?></td>
        </tr>
        <tr>
          <td><strong>Product Colour</strong></td>
          <td><?php echo $readrow['fld_product_colour'] ?></td>
        </tr>
          <td><strong>Price</strong></td>
          <td>RM<?php echo $readrow['fld_product_price'] ?></td>
        </tr>  
      </table>
      </div>
      </div>
                            
                     
</table>
 <form action="cart.php" onsubmit="return validateForm()" method="post" class="form-horizontal" name="frmorder" id="forder">
      <div class="row">
    <div class="col-sm-offset-2 col-xs-9 col-sm-9 col-md-9">
      <div class="page-header">
        <h2>Add To Cart</h2>
      </div>
      
                      <div class="form-group">
                          <label for="pid" class="col-sm-3 control-label">Product ID</label>
                                   <div class="col-sm-9">
                            <input name="pid" type="text" class="form-control" id="poi" placeholder="Insert Product Id" min="1" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_id']; ?>" required> 
                      </div>
                      </div>
              <br>
                         <div class="form-group">
                              <label for="qty" class="col-sm-3 control-label">Quantity</label>
                               <div class="col-sm-9">
                                <input name="quantity" type="number" class="form-control" id="qty" placeholder="Quantity" min="1" required> 
                          </div>
                          </div>

              
              <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                   <?php if (isset($_GET['edit'])) { ?>
                  <input name="pid" type="hidden" value="<?php echo $readrow['fld_product_id'] ?>">
                      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
                        <?php } else { ?>  
                      <button class="btn btn-success" onsubmit=validateForm() type="submit" name="addcart"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add To Cart</button>
                <?php } ?>
                 <a class="btn btn-success" a class="btn btn-success" href="catalogue.php">Back</a>
        </div>
      </div>
    
 </div>
      </form>
        </div>
        </div>
</div></form></div></div></div>

        
<script type="text/javascript">
 
  function validateForm() {

 
      //var x = document.forms["frmorder"]["pid"].value;
      //var y = document.forms["frmorder"]["quantity"].value;
      var y = document.getElementById("qty").value;
      if (y == null || y == "") {
          alert("Quantity must be filled out");
          //document.forms["frmorder"]["quantity"].focus();
          document.getElementById("qty").focus();
          return false;
      }
       
      return true;
  }
 
</script>
  <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <p class="pull-left">Copyright © 2016 Women Watch Shop SDN.BHD All rights reserved.</p>
          <p class="pull-right">Designed by WomenWatchShop</a></span></p>
        </div>
      </div>
    </div>
    
  </footer><!--/Footer-->
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html