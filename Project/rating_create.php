<?php 
	
	require 'database.php';
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
			
		
		// validate input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Restaurant Name.';
			$valid = false;
		}
		if (empty($reviewname)) {
			$nameError = 'Please enter reviewers name.';
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
		
echo $name . $rating . $comment;		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO ratings (restaurant_name, restaurant_reviewname,restaurant_rating,restaurant_comment) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$reviewname,$rating,$comment));
			Database::disconnect();
			header("Location: rating.php");
		}
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
		    			<h3>Create a Rating</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="rating_create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Restaurant Name</label>
					    <div class="controls">
					      	<input name="restaurant_name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  		  <div class="control-group <?php echo !empty($reviewnameError)?'error':'';?>">
					    <label class="control-label">Review Name</label>
					    <div class="controls">
					      	<input name="restaurant_reviewname" type="text"  placeholder="Name" value="<?php echo !empty($reviewname)?$reviewname:'';?>">
					      	<?php if (!empty($reviewnameError)): ?>
					      		<span class="help-inline"><?php echo $reviewnameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($ratingError)?'error':'';?>">
					    <label class="control-label">Rating</label>
					    <div class="controls">
					      	<input name="restaurant_rating" type="text" placeholder="rating" value="<?php echo !empty($rating)?$rating:'';?>">
					      	<?php if (!empty($ratingError)): ?>
					      		<span class="help-inline"><?php echo $ratingError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($commentError)?'error':'';?>">
					    <label class="control-label">Comment</label>
					    <div class="controls">
					      	<input name="restaurant_comment" type="text" placeholder="comment" value="<?php echo !empty($comment)?$comment:'';?>">
					      	<?php if (!empty($commentError)): ?>
					      		<span class="help-inline"><?php echo $commentError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="rating.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>