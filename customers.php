<?php
  include_once 'customers_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title></title>
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
        <h2>Create New customers</h2>
      </div>
    <form action="customers.php" method="POST">
    
       <div class="form-group">
          <label for="customersid" class="col-sm-3 control-label">Customer ID</label>
          <div class="col-sm-9">
       <input required name="cid" type="text" class="form-control" id="customersid" placeholder="Customers ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_id']; ?>" required>
      
    <br>

      </div>
        </div>
      <div class="form-group">
          <label for="custname" class="col-sm-3 control-label">Customer Name</label>
          <div class="col-sm-9">
       <input required name="name" type="text" class="form-control" id="custname" placeholder="Customer Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_name']; ?>"required>
    <br>

      </div>
        </div>
        <div class="form-group">
          <label for="custemail" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
       <input required name="email" type="text" class="form-control" id="custemail" placeholder="Customer Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_email']; ?>"required>
  
  <br>


      </div>
        </div>
        <div class="form-group">
          <label for="custphone" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
       <input required name="phone" type="text" class="form-control" id="custphone" placeholder="Phone Number" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_customer_phonenum']; ?>"required>
  <br>

   </div>
        </div>
        <div class="form-group">
           <label for="gender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
              <label>
         <input name="gender" type="radio" id="gender" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Male") echo "checked"; ?> required> Male
            </label>
          </div>
          <div class="radio">
              <label>
       <input name="gender" type="radio" id="gender" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_customer_gender']=="Female") echo "checked"; ?> required> Female
            </label>
  
      </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
        <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_customers_id']; ?>">
      
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
       </div>
      </div>
    </form>
    </div>
  </div>
 
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Customer List</h2>
      </div>
      <table class="table table-striped table-bordered">

      <tr>
        <th>Customer ID</th>
        <th>Customer Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th></th>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a172275_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_customer_id']; ?></td>
        <td><?php echo $readrow['fld_customer_name']; ?></td>
        <td><?php echo $readrow['fld_customer_gender']; ?></td>
        <td><?php echo $readrow['fld_customer_email']; ?></td>
        <td><?php echo $readrow['fld_customer_phonenum']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['fld_customer_id']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
          <a href="customers.php?delete=<?php echo $readrow['fld_customer_id']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
  </div>
  </div>
  </div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>