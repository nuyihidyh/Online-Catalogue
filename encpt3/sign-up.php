<html lang = "en">
   
   <head>
      <title>women Watch Shop!</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="username"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
      
   </head>

	<?php
session_start();
require_once('class.user.php');
$user = new USER();



if(isset($_POST['btn-signup']))
{
   $uname = strip_tags($_POST['txt_uname']);
   $umail = strip_tags($_POST['txt_umail']);
   $upass = strip_tags($_POST['txt_upass']); 
   
   if($uname=="") {
      $error[] = "provide username !"; 
   }
   else if($umail=="")  {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))   {
       $error[] = 'Please enter a valid email address !';
   }
   else if($upass=="")  {
      $error[] = "provide password !";
   }
   else if(strlen($upass) < 6){
      $error[] = "Password must be atleast 6 characters";   
   }
   else
   {
      try
      {
         $stmt = $user->runQuery("SELECT user_name, user_email FROM tbl_users_a149771 WHERE user_name=:uname OR user_email=:umail");
         $stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
            
         if($row['user_name']==$uname) {
            $error[] = "sorry username already taken !";
         }
         else if($row['user_email']==$umail) {
            $error[] = "sorry email id already taken !";
         }
         else
         {
            if($user->register($uname,$umail,$upass)){   
               $user->redirect('sign-up.php?joined');
            }
         }
      }
      catch(PDOException $e)
      {
         echo $e->getMessage();
      }
   }  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>RINGS SHOP : Sign-up</title>

</head>
<body>

<div class="signin-form">

<div class="container">
      
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Women Watch Shop Customer Sign up.</h2><hr />
            <?php
         if(isset($error))
         {
            foreach($error as $error)
            {
                ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
            }
         }
         else if(isset($_GET['joined']))
         {
             ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Successfully registered <a href='login.php'>login</a> here
                 </div>
                 <?php
         }
         ?>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Username" value="<?php if(isset($error)){echo $uname;}?>" />
            </div>
            <div class="form-group">
            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" />
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" />
            </div>
            <div class="clearfix"></div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary" name="btn-signup">
                  <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <label>Already have an account! <a href="login.php">Login</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>