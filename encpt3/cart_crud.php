<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['addcart'])) {
  try {
    
    $stmt = $conn->prepare("INSERT INTO tbl_cart_a149771(fld_cart_id, fld_product_id, fld_cart_quantity) VALUES(:did, :pid, :quantity)");

    $stmt->bindParam(':did', $did, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
 
    $did = uniqid('D', true);
    $pid= $_POST['pid']; 
    $quantity= $_POST['quantity']; 

    $stmt->execute();
    }

  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }

  $_GET['did'] = $did;
}
//update
 if (isset($_POST['update'])) {
 
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_cart_a149771 SET fld_cart_id = :did, fld_product_id = :pid, fld_cart_quantity = :quantity WHERE fld_cart_id = :olddid");
     
     $stmt->bindParam(':did', $did, PDO::PARAM_STR);
      $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':olddid', $olddid, PDO::PARAM_STR);
       
    $did = $_POST['did'];
    $pid = $_POST['pid'];
    $quantity = $_POST['quantity'];
    $olddid = $_POST['olddid'];
     
    $stmt->execute();
 
    header("Location: cart.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}


//Delete
if (isset($_GET['delete'])) {
 
  try {
 
    $stmt = $conn->prepare("DELETE FROM tbl_cart_a149771 WHERE fld_cart_id = :did");
   
    $stmt->bindParam(':did', $did, PDO::PARAM_STR);
       
    $did = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: cart.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
?>