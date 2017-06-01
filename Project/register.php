<?php
/* ---------------------------------------------------------------------------
* filename    : upload.php
* author      : Kyle Sorenson
* description : This file allows a user to be registered to the database.
: Some code was obtained from 
: https://www.youtube.com/watch?v=lGYixKGiY7Y
* ---------------------------------------------------------------------------
*/
session_start();
//connect to database
$db=mysqli_connect("localhost","kjsorens","411079","kjsorens");
if(isset($_POST['register_btn']))
{
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
if($password==$password2)
{      //Create User
$sql="INSERT INTO customers(name,username,password) VALUES('$username','$email','$password')";
mysqli_query($db,$sql);  
$_SESSION['message']="You are now logged in"; 
$_SESSION['username']=$username;
header("location:rating.php");
}
else
{
$_SESSION['message']="The two password do not match";   
}
}			
?>
<?php
if(isset($_SESSION['message']))
{
echo "<div id='error_msg'>".$_SESSION['message']."</div>";
unset($_SESSION['message']);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js">
    </script>
    <link rel="icon" href="cardinal_logo.png" type="image/png" />
  </head>
  <body>
    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Restaurant Rating Registration
          </h3>
        </div>
        <form class="form-horizontal" action="register.php" method="post">
          <div class="control-group">
            <label class="control-label">Username (Email)
            </label>
            <div class="controls">
              <input name="email" type="text"  placeholder="me@email.com" required> 
            </div>	
          </div> 
          <div class="control-group">
            <label class="control-label">Name 
            </label>
            <div class="controls">
              <input name="username" type="text"  placeholder="Name" required> 
            </div>	
          </div> 
          <div class="control-group">
            <label class="control-label">Password
            </label>
            <div class="controls">
              <input name="password" type="password" required> 
            </div>	
          </div> 
          <div class="control-group">
            <label class="control-label">Password
            </label>
            <div class="controls">
              <input name="password2" type="password" required> 
            </div>	
          </div> 
          <div class="form-actions">
            <button type="submit" name="register_btn"  class="btn btn-success">Register
            </button>
            &nbsp; &nbsp;					
            <a class="btn btn-primary" href="login.php">Back
            </a>
          </div>
          <footer>
            <small>&copy; Copyright 2017, George Corser
            </small>
          </footer>
        </form>
      </div> 
      <!-- end div: class="span10 offset1" -->				
    </div> 
    <!-- end div: class="container" -->
  </body> 
</html>