 <?php
  include_once 'products_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>MyBookStore | Search</title>
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
   
  <?php include_once 'nav_bar.php'; ?>
 
<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Search</h2>
      </div>
    <table>
    <form method="post">
      <tr>
      <td> </td>
      <td> </td>
      </tr> <tr>

        <td><input name="st1" type="text" class="form-control" placeholder="Search keyword" required></td>
        <td>
       <input type="submit" class="form-control" name="search" value="Search" style="width: 80px; background-color: lightblue; "></td>
       
       </tr>
      </form>
      </table>
    </div>
  </div><br>

<!-- thumbnail -->
<div class="container">

 <div class="col-md-9">
 <div class="row">

  <?php

   $per_page = 2;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a172275_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      ?>

 <?php
      if (isset($_POST['search']))
      {

      try {
        // $a=$_POST['s1'];
        $b=$_POST['st1'];
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a172275_pt2 where FLD_PRICE like '%$b%'  || FLD_AUTHOR like '%$b%'  || FLD_PRODUCT_NAME like '%$b%' || FLD_PRODUCT_NAME like '%$b%' ");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?> 
     
      <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail" style="height: 340px; position: relative;">
                           <img src="<?php echo "products/".$readrow['FLD_PRODUCT_IMAGE']; ?>" class="img-responsive" width="40%" height="15%">
                            <div class="caption">
                                <h4><a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>"><?php echo $readrow['FLD_PRODUCT_NAME']; ?></a>
                                </h4><br>

                                <h4 class="pull-right">RM <?php echo $readrow['FLD_PRICE'];?></h4>
                                
                            </div>
                               <div class="ratings">
                               Author : <?php echo $readrow['FLD_AUTHOR']; ?> 
                            </div>
                            <div class="ratings">
                               Category : <?php echo $readrow['FLD_CATEGORIES']; ?> 
                            </div>
                            <div class="ratings">
                               Availability  : <?php if($readrow['FLD_AVAILABILITY']==1) echo "Yes"; else echo "No"; ?><br>
                           </div>
                            
                        </div>
                    </div>
      
     
 
     <?php }} ?>  

 </div>
  </div>
 
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
 
</body>
</html>

       
