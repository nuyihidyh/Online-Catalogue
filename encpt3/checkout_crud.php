<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_payment_a149771(fld_pay_id, fld_your_name, fld_bank_name, fld_account_no ) VALUES(:pyd, :yourname, :bankname,:account)");
   
    $stmt->bindParam(':pyd', $pyd, PDO::PARAM_INT);
    $stmt->bindParam(':yourname', $yourname, PDO::PARAM_STR);
    $stmt->bindParam(':bankname', $bankname, PDO::PARAM_STR);
    $stmt->bindParam(':account', $account, PDO::PARAM_INT);
      
    $pyd = $_POST['pyd'];
    $yourname = $_POST['yourname'];
    $bankname = $_POST['bankname'];
    $account = $_POST['account'];
       
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}