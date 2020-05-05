<?php
include_once 'products_crud.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MyBookStore</title>
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
					<h2>Create New Product</h2>
				</div>
				<form action="products.php" method="POST" class="form-horizontal" >
					<div class="form-group">
						<label for="productid" class="col-sm-3 control-label">Product ID</label>
						<div class="col-sm-9">
							<input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; ?>" <?php if(isset($_GET['edit'])) echo 'readonly'; ?> required>
						</div>
					</div>
					<div class="form-group">
						<label for="bookname" class="col-sm-3 control-label">Book Name</label>
						<div class="col-sm-9">
							<input name="name" type="text" class="form-control" id="bookname" placeholder="Book Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="bookauthor" class="col-sm-3 control-label">Author</label>
						<div class="col-sm-9">
							<input name="author" class="form-control" id="bookauthor" placeholder="Book Author" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_AUTHOR']; ?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="bookprice" class="col-sm-3 control-label">Price</label>
						<div class="col-sm-9">
							<input name="price" type="text" class="form-control" id="bookprice" placeholder="Book Price (RM)" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="bookcategories" class="col-sm-3 control-label">Categories</label>
						<div class="col-sm-9">
							<select name="categories" class="form-control" id="bookcategories" required>
								<option value="">Please select categories</option>
								<option value="Academic books" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Academic books") echo "selected"; ?>>Academic books</option>
								<option value="Biography/Autobiography" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Biography/Autobiography") echo "selected"; ?>>Biography/Autobiography</option>
								<option value="Guides/Manuals/Handbooks" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Guides/Manuals/Handbooks") echo "selected"; ?>>Guides/Manuals/Handbooks</option>
								<option value="Journalism" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Journalism") echo "selected"; ?>>Journalism</option>
								<option value="Self-help/Self-improvement" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Self-help/Self-improvement") echo "selected"; ?>>Self-help/Self-improvement</option>
								<option value="Travelogues/Travel Literature" <?php if(isset($_GET['edit'])) if($editrow['FLD_CATEGORIES']=="Travelogues/Travel Literature") echo "selected"; ?>>Travelogues/Travel Literature</option>
							</select>
						</div>
					</div>    
					<div class="form-group">
						<label for="bookavailability" class="col-sm-3 control-label">Availability</label>
						<div class="col-sm-9">
							<div class="radio">
								<label>
									<input name="availability" type="radio" value="1" <?php if(isset($_GET['edit'])) if($editrow['FLD_AVAILABILITY']==1) echo "checked"; ?>> Yes
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="availability" type="radio" value="0" <?php if(isset($_GET['edit'])) if($editrow['FLD_AVAILABILITY']==0) echo "checked"; ?>> No
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="bookdesc" class="col-sm-3 control-label">Desciption</label>
						<div class="col-sm-9">
							<textarea required class="form-control" id="bookdesc" placeholder="Book Desciption" name="description" rows="5" cols="40"><?php if(isset($_GET['edit'])) echo $editrow['FLD_DESCRIPTION']; ?></textarea></div>
						</div>
			<!--
			Description
			<textarea rows="4" cols="50">
			</textarea>
		-->
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<?php if (isset($_GET['edit'])) { ?>
				<input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
				<button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
				<?php } else { ?>
				<button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
				<?php } ?>
				<button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
			</div>
		</div>
	</form>
	<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <div class="page-header">
        <h2>Products List</h2>
      </div>
      <table class="table table-striped table-bordered">
		<tr>
			<th>Product ID</th>
			<th>Name</th>
			<th>Price (RM)</th>
			<th>Description</th>
			<th></th>
		</tr>
		<?php
      // Read
		$per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT * FROM tbl_products_a172275_pt2 LIMIT $start_from, $per_page");
			//$stmt = $conn->prepare("SELECT * FROM tbl_products_a172275_pt2");
			$stmt->execute();
			$result = $stmt->fetchAll();
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		foreach($result as $readrow) {
			?>   
			<tr>
				<td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
				<td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
				<td><?php echo $readrow['FLD_PRICE'].'.00'; ?></td>
				<td><?php echo $readrow['FLD_CATEGORIES']; ?></td>
				<td>

				 <?php } ?>
				<?php if ($_SESSION["level"]== 1){ ?>  
					
					<a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>"class="btn btn-warning btn-xs" role="button">Details</a>

					<a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>

					<a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
				</td>
			</tr>
			<?php
		}
		$conn = null;
		?>

	</table>
	</div>
  </div>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
      <nav>
          <ul class="pagination">
          <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a172275_pt2");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
          <?php if ($page==1) { ?>
            <li class="disabled"><span aria-hidden="true">«</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
          <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
          ?>
          <?php if ($page==$total_pages) { ?>
            <li class="disabled"><span aria-hidden="true">»</span></li>
          <?php } else { ?>
            <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>