<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a172275_pt2(FLD_PRODUCT_ID,
        FLD_PRODUCT_NAME, FLD_PRICE, FLD_CATEGORIES, FLD_AVAILABILITY, FLD_AUTHOR, FLD_DESCRIPTION) VALUES(:pid, :name, :price, :categories, :availability, :author, :description)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
      $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
      $stmt->bindParam(':author', $author, PDO::PARAM_STR);
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categories =  $_POST['categories'];
    $availability = $_POST['availability'];
    $author = $_POST['author'];
    $description = $_POST['description'];
     
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
 
      $stmt = $conn->prepare("UPDATE tbl_products_a172275_pt2 SET FLD_PRODUCT_ID = :pid,
        FLD_PRODUCT_NAME = :name, FLD_PRICE = :price, FLD_CATEGORIES = :categories,
        FLD_AVAILABILITY = :availability, FLD_AUTHOR = :author, FLD_DESCRIPTION = :description
        WHERE FLD_PRODUCT_ID = :oldpid");

      //UPDATE `a172275`.`tbl_products_a172275_pt2` SET `FLD_PRODUCT_ID` = 'Test123456', `FLD_PRODUCT_NAME` = 'TESTTESTTESTs', `FLD_PRICE` = '999', `FLD_CATEGORIES` = 'Academic books', `FLD_AVAILABILITY` = '1', `FLD_AUTHOR` = 'TESTTESTTESTs', `FLD_DESCRIPTION` = 'TESTTESTTESTTESTfhhhs' WHERE `tbl_products_a172275_pt2`.`FLD_PRODUCT_ID` = 'Test12345';
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':categories', $categories, PDO::PARAM_STR);
      $stmt->bindParam(':availability', $availability, PDO::PARAM_INT);
      $stmt->bindParam(':author', $author, PDO::PARAM_STR);
      //$stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR); ////////
      $stmt->bindParam(':description', $description, PDO::PARAM_STR);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $categories =  $_POST['categories'];
    $availability = $_POST['availability'];
    $author = $_POST['author'];
    $description = $_POST['description'];
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
 
      $stmt = $conn->prepare("DELETE FROM tbl_products_a172275_pt2 WHERE FLD_PRODUCT_ID = :pid");
     
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
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a172275_pt2 WHERE FLD_PRODUCT_ID = :pid");
     
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