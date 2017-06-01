<!DOCTYPE html>
<!--
/* ---------------------------------------------------------------------------
* filename    : restaurant.php
* author      : Kyle Sorenson
* description : This file allows the user to see address of restaurants.
* ---------------------------------------------------------------------------
*/
-->
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
        <h3>Restaurant List
        </h3>
      </div>
      <div class="row">
        <p>
          <a href="restaurant_create.php" class="btn btn-success">Create
          </a>
          <a href="rating.php" class="btn btn-success">Back
          </a>
          <a href="logout.php" class="btn btn-success">Logout
          </a>
        </p>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Restaurant Name
              </th>
              <th>Address
              </th>
              <th>Phone
              </th>
              <th>Action
              </th>
            </tr>
          </thead>
          <tbody>
            <?php 
include 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM restaurants ORDER BY id DESC';
foreach ($pdo->query($sql) as $row) {
echo '<tr>';
echo '<td>'. $row['restaurant_name'] . '</td>';
echo '<td>'. $row['restaurant_address'] . '</td>';
echo '<td>'. $row['restaurant_phone'] . '</td>';
echo '<td width=250>';
echo '<a class="btn" href="restaurant_read.php?id='.$row['id'].'">Read</a>';
echo '&nbsp;';
echo '<a class="btn btn-success" href="restaurant_update.php?id='.$row['id'].'">Update</a>';
echo '&nbsp;';
echo '<a class="btn btn-danger" href="restaurant_delete.php?id='.$row['id'].'">Delete</a>';
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