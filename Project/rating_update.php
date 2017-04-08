<?php 
	
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: rating.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$reviewnameError = null;
		$ratingError = null;
		$commentError = null;
	
		
		// keep track post values
		$name = $_POST['restaurant_name'];
		$reviewname = $_POST['restaurant_reviewname'];
		$rating = $_POST['restaurant_rating'];
		$comment = $_POST['restaurant_comment'];
		
		
		// valiname input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Restaurant name';
			$valid = false;
		}
		if (empty($name)) {
			$reviewnameError = 'Please enter Reviewers name';
			$valid = false;
		}
		if (empty($rating)) {
			$ratingError = 'Please enter rating';
			$valid = false;
		} 
		
		if (empty($comment)) {
			$commentError = 'Please enter comment';
			$valid = false;
		}
	
		// Update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Update ratings  set restaurant_name = ?, restaurant_reviewname = ?, restaurant_rating = ?, restaurant_comment = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$reviewname,$rating,$comment,$id));
			Database::disconnect();
			header("Location: rating.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM ratings where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['restaurant_name'];
		$reviewname = $data['restaurant_reviewname'];
		$rating = $data['restaurant_rating'];
		$comment = $data['restaurant_comment'];
	
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
		    			<h3>Update a Rating</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="rating_update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Restaurant Name</label>
					    <div class="controls">
					      	<input name="restaurant_name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($reviewnameError)?'error':'';?>">
					    <label class="control-label">Reviewer's Name</label>
					    <div class="controls">
					      	<input name="restaurant_reviewname" type="text"  placeholder="reviewer" value="<?php echo !empty($reviewname)?$reviewname:'';?>">
					      	<?php if (!empty($reviewnameError)): ?>
					      		<span class="help-inline"><?php echo $reviewnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  
					  <div class="control-group <?php echo !empty($ratingError)?'error':'';?>">
					    <label class="control-label">Rating</label>
					    <div class="controls">
					      	<input name="restaurant_rating" type="text"  placeholder="rating" value="<?php echo !empty($rating)?$rating:'';?>">
					      	<?php if (!empty($ratingError)): ?>
					      		<span class="help-inline"><?php echo $ratingError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
						  <div class="control-group <?php echo !empty($commentError)?'error':'';?>">
					    <label class="control-label">Comment</label>
					    <div class="controls">
					      	<input name="restaurant_comment" type="text"  placeholder="comment" value="<?php echo !empty($comment)?$comment:'';?>">
					      	<?php if (!empty($commentError)): ?>
					      		<span class="help-inline"><?php echo $commentError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="rating.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>