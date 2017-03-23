<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_team_create.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program adds/inserts a new team (table: mc_teams)
 * ---------------------------------------------------------------------------
 */

require '../database/database.php';
require 'functions.php';

if ( !empty($_POST)) { // if user entered data...

	# same as mc_team_update.php

	// initialize user input validation variables
	$teamError = null;
	$schoolError = null;
	
	// initialize $_POST variables
	$team = $_POST['team'];    
	$school = $_POST['school'];
	
	// validate user input
	$valid = true;
	if (empty($team)) {
		$teamError = 'Please enter a team name';
		$valid = false;
	}
	if (empty($school)) {
		$schoolError = 'Please choose a school';
		$valid = false;
	} 
		
	// insert data...
	if ($valid) {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO mc_teams (team_name,team_school) values(?, ?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($team,$school));
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
				<h3>Add a new team</h3>
			</div>
			
			<!-- Display the data entry form -->
	
			<form class="form-horizontal" action="mc_team_create.php" method="post">
			
				<div class="control-group <?php echo !empty($teamError)?'error':'';?>">
					<label class="control-label">Team Name</label>
					<div class="controls">
						<input name="team" type="text" placeholder="Lucky Lawyers" value="<?php echo !empty($team)?$team:'';?>">
						<?php if (!empty($teamError)): ?>
							<span class="help-inline"><?php echo $teamError;?></span>
						<?php endif;?>
					</div>
				</div>
			  
				<div class="control-group">
					<label class="control-label">School</label>
					<div class="controls">
						<?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM mc_schools ORDER BY school_name ASC';
							echo "<select class='form-control' name='school' id='school_id'>";
							foreach ($pdo->query($sql) as $row) {
								echo "<option value='" . $row['id'] . " '> " . $row['school_name'] . "</option>";
							}
							echo "</select>";
							Database::disconnect();
						?>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Confirm</button>
						<a class="btn" href="mc_teams.php">Back</a>
				</div>
				
			</form>
			
		</div> <!-- end div: class="span10 offset1" -->

    </div> <!-- end div: class="container" -->

  </body>
</html>