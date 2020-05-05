 <?php  
 //login_success.php  
 session_start();  
 if(isset($_SESSION["fld_staff_id"]))  
 {  
      echo '<h3>Login Success, Welcome - '.$_SESSION["fld_staff_id"].'</h3>';  
      header("location:index.php");  
      //echo '<br /><br /><a href="logout.php">Logout</a>';  
 }  
 else  
 {  
      header("location:pdo_login.php");  
 }  
 ?>  