<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_school_update.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program updates a school (table: mc_schools)
 * ---------------------------------------------------------------------------
 */

require '../database/database.php';
require 'functions.php';

$id = $_GET['id'];

if ( !empty($_POST)) { // if $_POST filled then process the form
	
	# same as mc_school_create.php

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
		
	if ($valid) { // if valid user input update the database
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE mc_schools set school_name = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($school,$id));
		Database::disconnect();
		header("Location: mc_schools.php");
	}
} else { // if $_POST NOT filled then pre-populate the form
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM mc_schools where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	$school = $data['school_name'];
	Database::disconnect();
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
		
			<div class="row">
				<h3>Update School Name</h3>
			</div>
	
			<form class="form-horizontal" action="mc_school_update.php?id=<?php echo $id?>" method="post">
			
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
					<button type="submit" class="btn btn-success">Update</button>
					<a class="btn" href="mc_schools.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
</html>