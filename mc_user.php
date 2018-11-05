<?php 
require '../database/database.php';
require 'functions.php';

if (!empty($_POST)) { // if user entered data...

	# same as mc_school_update.php

	// initialize user input validation variables
	$usernameError = null;
	
	// initialize $_POST variables  
	$username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	
	// validate user input
	$valid = true;
    if (empty($email)) {
		$emailError = 'Please enter an email address';
		$valid = false;
	} 
    if (empty($password)) {
		$passwordError = 'Please enter a password';
		$valid = false;
	} 
		
	// insert data...
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO mc_users (email,password) values(?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($email,md5($password)));
		Database::disconnect();
		header("Location: mc_teams.php"); // ...and return to menu/list
	}
	// otherwise, show the html form (below) to enter the data 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="cardinal_logo.png" type="image/png" />
</head>

<body>
    <div class="container">
	
	    <?php 
			//gets logo
			functions::logoDisplay();
		?>
    
		<div class="span10 offset1">
			
			<!-- Display title of screen -->
			
			<div class="row">
				<h3>Create Account</h3>
			</div>
			
			<!-- Display the data entry form -->
	
			<form class="form-horizontal" action="mc_user.php" method="post">
			  
                <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					<label class="control-label">Email</label>
					<div class="controls">
						<input name="email" type="text" placeholder="email@address.com" value="<?php echo !empty($email)?$email:'';?>">
						<?php if (!empty($emailError)): ?>
							<span class="help-inline"><?php echo $emailError;?></span>
						<?php endif;?>
					</div>
				</div>

                <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="password" value="<?php echo !empty($password)?$password:'';?>">
						<?php if (!empty($passwordError)): ?>
							<span class="help-inline"><?php echo $passwordError;?></span>
						<?php endif;?>
					</div>
				</div>
			  
				<div class="form-actions">
					<button type="submit" class="btn btn-success">Confirm</button>
						<a class="btn" href="mc_schools.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- end div: class="span10 offset1" -->

    </div> <!-- end div: class="container" -->

  </body>
</html>