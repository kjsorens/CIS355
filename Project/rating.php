<?php
/* ---------------------------------------------------------------------------
* filename    : rating.php
* author      : Kyle Sorenson
* description : This file is the "home" for the user.  The user will also
: be able to see a list of reviews along with other options.
* ---------------------------------------------------------------------------
*/
session_start();
//connect to database
$db=mysqli_connect("localhost","kjsorens","411079","kjsorens"); 
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
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h3>Restaurant Ratings
        </h3>
      </div>
      <div class="row">
        <p>
          <a href="rating_create.php" class="btn btn-success">Create
          </a>
          <a href="upload.php" class="btn btn-success">Upload
          </a>		
          <a href="q1.php" class="btn btn-success">My Reviews
          </a>
          <a href="search.php" class="btn btn-success">Search Restaurants
          </a>
          <a href="restaurant.php" class="btn btn-success">Restaurant Locations
          </a>
          <a href="logout.php" class="btn btn-success">Logout
          </a>
        <h4>Welcome 
          <?php echo $_SESSION['username']; ?>
        </h4>
      </div>
      <div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Restaurant Name
              </th>
              <th>Review Name
              </th>
              <th>Rating
              </th>
              <th>Comments
              </th>
              <th>Action
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
include 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM ratings ORDER BY id DESC';
foreach ($pdo->query($sql) as $row) {
echo '<tr>';
echo '<td>'. $row['restaurant_name'] . '</td>';
echo '<td>'. $row['restaurant_reviewname'] . '</td>';
echo '<td>'. $row['restaurant_rating'] . '</td>';
echo '<td>'. $row['restaurant_comment'] . '</td>';
echo '<td width=250>';
echo '<a class="btn" href="rating_read.php?id='.$row['id'].'">Read</a>';
// 	echo '&nbsp;';
// 	echo '<a class="btn btn-success" href="rating_update.php?id='.$row['id'].'">Update</a>';
// 	echo '&nbsp;';
//  	echo '<a class="btn btn-danger" href="rating_delete.php?id='.$row['id'].'">Delete</a>';
echo '</td>';
echo '</tr>';
}
Database::disconnect();
?>
          </tbody>
        </table>
      </div>
    </div> 
    <!-- /container -->
  </body>
</html>