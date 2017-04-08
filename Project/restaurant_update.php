<?php 
	
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: restaurant.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$addressError = null;
		$phoneError = null;
	
		
		// keep track post values
		$name = $_POST['restaurant_name'];
		$address = $_POST['restaurant_address'];
		$phone = $_POST['restaurant_phone'];
		
		
		// valiname input
		$valid = true;
		if (empty($name)) {
			$nameError = 'Please enter Restaurant name';
			$valid = false;
		}
		
		if (empty($address)) {
			$addressError = 'Please enter address';
			$valid = false;
		} 
		
		if (empty($phone)) {
			$phoneError = 'Please enter phone';
			$valid = false;
		}
	
		// Update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "Update restaurants  set restaurant_name = ?, restaurant_address = ?, restaurant_phone = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($name,$address,$phone,$id));
			Database::disconnect();
			header("Location: restaurant.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM restaurants where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$name = $data['restaurant_name'];
		$address = $data['restaurant_address'];
		$phone = $data['restaurant_phone'];
	
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
		    			<h3>Update an Event</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="restaurant_update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Restaurant Name</label>
					    <div class="controls">
					      	<input name="restaurant_name" type="text"  placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($addressError)?'error':'';?>">
					    <label class="control-label">Address</label>
					    <div class="controls">
					      	<input name="restaurant_address" type="text"  placeholder="address" value="<?php echo !empty($address)?$address:'';?>">
					      	<?php if (!empty($addressError)): ?>
					      		<span class="help-inline"><?php echo $addressError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
						  <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
					    <label class="control-label">Phone</label>
					    <div class="controls">
					      	<input name="restaurant_phone" type="text"  placeholder="phone" value="<?php echo !empty($phone)?$phone:'';?>">
					      	<?php if (!empty($phoneError)): ?>
					      		<span class="help-inline"><?php echo $phoneError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="restaurant.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>