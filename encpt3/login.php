<?php
session_start();
require_once("class.user.php");
$login = new USER();



if(isset($_POST['btn-login']))
{
    $uname = strip_tags($_POST['txt_uname_email']);
    $umail = strip_tags($_POST['txt_uname_email']);
    $upass = strip_tags($_POST['txt_password']);
        
    if($login->doLogin($uname,$umail,$upass))
    {
        $login->redirect('catalogue.php');
    }
    else
    {
        $error = "Wrong Details !";
    }   
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WomenWatchShop Sdn. Bhd.</title>

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
      <a class="navbar-brand" href="index.php">WomenWatchShop Online Shop</a>
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


<div class="signin-form">

    <div class="container">
     <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
     <div class="row">
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Customer Log In.</h2><hr />
        
        <div id="error">
        <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
            }
        ?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Your Password" />
        </div>
       
          <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>

        <hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-default">
                    <i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
            </button>
        </div>  
            <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>
      </form>

    </div>
    
</div>
    
    

        <!-- Footer -->
        

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
