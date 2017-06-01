<?php
/* ---------------------------------------------------------------------------
* filename    : search.php
* author      : Kyle Sorenson
* description : This file allows the user to search for any review in the DB
: Credit: https://www.youtube.com/watch?v=2XuxFi85GTw
* ---------------------------------------------------------------------------
*/
if(isset($_POST['search']))
{
$valueToSearch = $_POST['valueToSearch'];
// search in all table columns
// using concat mysql function
$query = "SELECT * FROM ratings WHERE CONCAT(`id`, `restaurant_name`, `restaurant_reviewname`, `restaurant_rating` ,`restaurant_comment` ) LIKE '%".$valueToSearch."%'";
$search_result = filterTable($query);
}
else {
$query = "SELECT * FROM `ratings";
$search_result = filterTable($query);
}
// function to connect and execute the query
function filterTable($query)
{
$connect = mysqli_connect("localhost", "kjsorens", "411079", "kjsorens");
$filter_Result = mysqli_query($connect, $query);
return $filter_Result;
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
        <h3>Search Restaurants
        </h3>
      </div>
      <div class="row">
        <p>
          <a href="rating.php" class="btn btn-success">Back
          </a>
          <a href="logout.php" class="btn btn-success">Logout
          </a>
          <br>
        </br>
    </div>
    <div>
      <form action="search.php" method="post">
        <input type="text" name="valueToSearch" placeholder="Search for anything!">
        <br>
        <br>
        <input type="submit" name="search" value="Filter">
        <br>
        <br>
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
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_array($search_result)):?>
            <tr>
              <td>
                <?php echo $row['restaurant_name'];?>
              </td>
              <td>
                <?php echo $row['restaurant_reviewname'];?>
              </td>
              <td>
                <?php echo $row['restaurant_rating'];?>
              </td>
              <td>
                <?php echo $row['restaurant_comment'];?>
              </td>
            </tr>
            <?php endwhile;?>
          </tbody>
        </table>
        </div>
    </div> 
    <!-- /container -->
  </body>
</html>
