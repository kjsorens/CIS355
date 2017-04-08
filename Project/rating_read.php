<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: rating.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ratings where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read a Rating</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Restaurant Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['restaurant_name'];?>
						    </label>
					    </div>
					  </div>
					  	  <div class="control-group">
					    <label class="control-label">Reviwer's Name</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['restaurant_reviewname'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Rating</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['restaurant_rating'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Comments</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['restaurant_comment'];?>
						    </label>
					    </div>
					  </div>
					  
					    <div class="form-actions">
						  <a class="btn" href="rating.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>