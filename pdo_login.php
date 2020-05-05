<?php  
 session_start();  
 $host = "lrgs.ftsm.ukm.my";  
 $username = "a172275";  
 $password = "largeblackspider";  
 $database = "a172275";  
 $message = "";  
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["fld_staff_id"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM tbl_staffs_a172275_pt2 WHERE fld_staff_id = :fld_staff_id AND password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(  
                     array(  
                          'fld_staff_id'     =>     $_POST["fld_staff_id"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $statement->rowCount();  
                $readrow = $statement->fetch(PDO::FETCH_ASSOC);
                if($count > 0)  
                {  
                     $_SESSION["fld_staff_id"] = $_POST["fld_staff_id"]; 
                     $_SESSION["level"] = $readrow['level']; 
                     $_SESSION["fld_staff_fname"] = $readrow['fld_staff_fname'];
                     $_SESSION["fld_staff_lname"] = $readrow['fld_staff_lname'];  
                     header("location:login_success.php");  
                }  
                else  
                {  
                     $message = '<label>Wrong Data</label>';  
                }  
           }  
      }  
 }  
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Login</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 align="">Welcome To MyBookStore Login Page</h3><br />  
                <center><img src="logo.png" alt="MyBookStore" > </center>
                <form method="post">  
                     <label>Username</label>  
                     <input type="text" name="fld_staff_id" class="form-control" />  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="password" class="form-control" />  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  