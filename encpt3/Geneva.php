<?php
  include_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Women Watch Shop</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

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
            
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <div class="page-header">
            <h1>Online Catalogue</h1>
        </div>

            <div class="col-md-3">
                <p class="lead">Shop by categoris:</p>
                <div class="list-group">
                 <a href="catalogue.php" class="list-group-item">All categories</a>
                    <a href="Quartz.php?cat=Quartz" class="list-group-item">Quartz</a>
                    <a href="casio.php?cat=casio" class="list-group-item">Casio</a>
                    <a href="Winner.php?cat=Winner" class="list-group-item">Winner</a>
                    <a href="Geneva.php?cat=Geneva" class="list-group-item">Geneva</a>
                    <a href="Sinobi.php?cat=Sinobi" class="list-group-item">Sinobi</a>
                </div>
            </div>


            <div class="col-md-9">
                <div class="row">
                    <?php
                          // Read
                          $per_page = 8;
                          if (isset($_GET["page"]))
                            $page = $_GET["page"];
                          else
                            $page = 1;
                          $start_from = ($page-1) * $per_page;
                          try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("select * from tbl_products_a149771 WHERE fld_product_brand='Geneva' LIMIT $start_from, $per_page");
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                            $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
                          }
                          catch(PDOException $e){
                                echo "Error: " . $e->getMessage();
                          }
                          foreach($result as $readrow) {
                    ?>
            
                    <div class="col-sm-3 col-lg-3 col-md-3">
                        <div class="thumbnail">
                            <img src="products/<?php echo $readrow['fld_product_image'];?>" style = "width: 180px ; height: 200px">
                            <div class="caption" style="height:150px">
                                <h4 class="pull-right">RM <?php echo $readrow['fld_product_price'];?></h4>
                                <h4><a href="products_details.php?pid=<?php echo $readrow['fld_product_id'];?>"><?php echo $readrow['fld_product_id'];?></a>
                                </h4>
                                <p><?php echo $readrow['fld_product_name'];?> BY : <?php echo $readrow['fld_product_brand'];?></p>
                            </div>
                             <center>
                            <!--fieldset>
                                <label>
                                    <span>Quantity</span>
                                    <input type="text" size="2" maxlength="2" name="product_qty" value="1" />
                                </label>
                                </fieldset-->
                                </center>
                            <div class="caption" style="height:50px">
                                <a href="product-details.php?pid=<?php echo $readrow['fld_product_id'];?>" role="button" class="btn btn-primary btn-lg btn-block">Details</a>
                            </div>

                            <div class="caption">
                                
                            </div>
                            
                        </div> 
                    </div>
                    <?php } ?>
                </div>
                <div class="row">  
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-4 col-md-8 col-md-offset-4">
                        <nav>
                            <ul class="pagination">
                                            <!--li class="disabled"><a href="catalogue.php?page=0&cat=" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <li class="active"><a href="catalogue.php?page=1&cat=">1</a></li><li><a href="catalogue.php?page=2&cat=">2</a></li><li><a href="catalogue.php?page=3&cat=">3</a></li><li><a href="catalogue.php?page=4&cat=">4</a></li><li><a href="catalogue.php?page=5&cat=">5</a></li><li><a href="catalogue.php?page=6&cat=">6</a></li>                <li ><a href="catalogue.php?page=2&cat=" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li-->


                              <?php 
                              try {
                                      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                      $stmt = $conn->prepare("select fld_product_id, fld_product_name, fld_product_price, fld_product_quantity from tbl_products_a149771");
                                      $stmt->execute();
                                      $result = $stmt->fetchAll();
                                      $total_records = count($result);
                                         }
                                     catch(PDOException $e){
                                        echo "Error: " . $e->getMessage();
                                      }

                                    $total_pages = ceil($total_records/ $per_page);
                                    ?>

                                    <?php if ($page==1) { ?>
                                        <li class="disabled"><span aria-hidden="true">«</span></li>
                                      <?php } else { ?>
                                        <li><a href="catalogue.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                      <?php
                                    }
                                      for ($i=1; $i<=$total_pages; $i++) {
                                        if ($i == $page)
                                          echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
                                        else
                                          echo "<li><a href=\"catalogue.php?page=$i\">$i</a></li>"; }
                                      ?>
                                      <?php if ($page==$total_pages) { ?>
                                        <li class="disabled"><span aria-hidden="true">»</span></li>
                                      <?php } else { ?>
                                        <li><a href="catalogue.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
                                      <?php } ?>
                          </ul>
                        </nav>
                    </div>
                </div> <!-- row -->

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Women Watch Shop sdn.bhd</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
