<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_team_create.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program adds/inserts a new team (table: mc_teams)
 * ---------------------------------------------------------------------------
 */

require '../database/database.php';
require 'functions.php';
functions::requireSession();

if ( !empty($_POST)) { // if user entered data...

	# same as mc_school_update.php

	// initialize user input validation variables
	$schoolError = null;
	
	// initialize $_POST variables  
	$school = $_POST['school'];
	
	// validate user input
	$valid = true;
	if (empty($school)) {
		$schoolError = 'Please enter a school';
		$valid = false;
	} 
		
	// insert data...
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO mc_schools (school_name, user) values(?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($school,$_SESSION['session_id']));
		Database::disconnect();
		header("Location: mc_schools.php"); // ...and return to menu/list
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
				<h3>Add a new school</h3>
			</div>
			
			<!-- Display the data entry form -->
	
			<form class="form-horizontal" action="mc_school_create.php" method="post">
			  
				<div class="control-group <?php echo !empty($schoolError)?'error':'';?>">
					<label class="control-label">School Name</label>
					<div class="controls">
						<input name="school" type="text" placeholder="Flint Central HS" value="<?php echo !empty($school)?$school:'';?>">
						<?php if (!empty($schoolError)): ?>
							<span class="help-inline"><?php echo $schoolError;?></span>
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