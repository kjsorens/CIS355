<?php
/* ---------------------------------------------------------------------------
 * filename    : login.php
 * author      : Kyle Sorenson
 * description : This file allows the user to login to the Restaurant CRUD app
 * ---------------------------------------------------------------------------
 */
session_start();
//connect to database
$db=mysqli_connect("localhost","kjsorens","411079","kjsorens");
if(isset($_POST['login_btn']))
{
$username = $_POST['username'];
$password = $_POST['password'];
//Storing password in plain text is a bad idea but this is an example.
$sql="SELECT * FROM customers WHERE username='$username' AND password='$password'";
$result=mysqli_query($db,$sql);
if(mysqli_num_rows($result)==1)
{
$_SESSION['message']="You are now Loggged In";
$_SESSION['username']=$username;
header("location:rating.php");
}
else
{
//$_SESSION['message']="Username and Password combination incorrect";
echo "<script type='text/javascript'>alert('Invalid Login!')</script>";
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
          <h3>Restaurant Rating Login
          </h3>
        </div>
        <form class="form-horizontal" action="login.php" method="post">
          <div class="control-group">
            <label class="control-label">Username (Email)
            </label>
            <div class="controls">
              <input name="username" type="text"  placeholder="me@email.com" required> 
            </div>	
          </div> 
          <div class="control-group">
            <label class="control-label">Password
            </label>
            <div class="controls">
              <input name="password" type="password" required> 
            </div>	
          </div> 
          <div class="form-actions">
            <button type="submit" name="login_btn" class="btn btn-success">Sign in
            </button>
            &nbsp; &nbsp;
            <a class="btn btn-primary" href="register.php">Register
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