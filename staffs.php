<?php
  include_once 'staffs_crud.php';
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staffs</title>
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
  <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Staff</h2>
      </div>
    <form action="staffs.php" method="post">
      <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
      <input required name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_id']; ?>"> <br>
      </div>
        </div>
      <div class="form-group">
          <label for="fname" class="col-sm-3 control-label">First Name</label>
          <div class="col-sm-9">
      <input required name="fname" class="form-control" id="fname" placeholder="First Name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_fname']; ?>"><br>
      </div>
        </div>
      <div class="form-group">
          <label for="lname" class="col-sm-3 control-label">Last Name</label>
          <div class="col-sm-9">
      <input required name="lname" class="form-control" id="lname" placeholder="Last Name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_lname']; ?>"> <br>
      </div>
        </div>    
        <div class="form-group">
          <label for="gender" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
          <div class="radio">
            <label>
      <input name="gender" type="radio" value="Male" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?>> Male
       </label>
          </div>
          <div class="radio">
            <label>
              <input name="gender" type="radio" value="Female" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female <br>
      </label>
            </div>
          </div>
      </div>
      <div class="form-group">
          <label for="phonenum" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-9">
      <input required name="phone" class="form-control" id="phonenum" placeholder="Phone Number" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>"> <br>
      </div>
        </div>
      <div class="form-group">
          <label for="staffemail" class="col-sm-3 control-label">Email Address</label>
          <div class="col-sm-9">
      <input required name="email" class="form-control" id="staffemail" placeholder="Email" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>"> <br>
      
       </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_id']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
      <?php } else { ?>

        <?php if ($_SESSION["level"] == 3 ) { ?>
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
      <?php } ?>

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
        <h2>Products List</h2>
      </div>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Staff ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th></th>
      </tr>
      
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a172275_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['fld_staff_id']; ?></td>
        <td><?php echo $readrow['fld_staff_fname']; ?></td>
        <td><?php echo $readrow['fld_staff_lname']; ?></td>
        <td><?php echo $readrow['fld_staff_gender']; ?></td>
        <td><?php echo $readrow['fld_staff_phone']; ?></td>
        <td><?php echo $readrow['fld_staff_email']; ?></td>
        <td>

          <?php if ($_SESSION["level"] == 3 || $_SESSION["level"] == 2 ) { ?>
          <a href="staffs.php?edit=<?php echo $readrow['fld_staff_id']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
          <?php } ?>

          <?php if ($_SESSION["level"] == 3 ) { ?>
          <a href="staffs.php?delete=<?php echo $readrow['fld_staff_id']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
          <?php } ?>
        </td>
      </tr>
      <?php
      }
      $conn = null;
      ?>
    </table>
  
</div>
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>