<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a149771(fld_product_id,fld_product_name, fld_product_price, fld_product_brand, fld_product_type,
        fld_product_colour, fld_product_warranty) VALUES(:pid, :name, :price, :brand,
        :type, :colour, :warranty)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':colour', $colour, PDO::PARAM_STR);
      $stmt->bindParam(':warranty', $warranty, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $colour = $_POST['colour'];
    $warranty = $_POST['warranty'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Update
if (isset($_POST['update'])) {
 
  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a149771 SET fld_product_id = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_type = :type, fld_product_colour = :colour, fld_product_warranty = :warranty
        WHERE fld_product_id = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':colour', $colour, PDO::PARAM_STR);
      $stmt->bindParam(':warranty', $warranty, PDO::PARAM_STR);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $brand =  $_POST['brand'];
    $type = $_POST['type'];
    $colour = $_POST['colour'];
    $warranty = $_POST['warranty'];
    $oldpid = $_POST['oldpid'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Delete
if (isset($_GET['delete'])) {
 
  try {
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a149771 WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['delete'];
     
    $stmt->execute();
 
    header("Location: products.php");
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
//Edit
if (isset($_GET['edit'])) {
 
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a149771 WHERE fld_product_id = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
    $pid = $_GET['edit'];
     
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}
 
  $conn = null;
?>