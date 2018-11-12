<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_team_delete.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program deletes one team (table: mc_teams)
 * ---------------------------------------------------------------------------
 */

require '../database/database.php';
require 'functions.php';
functions::requireSession();

$id = $_GET['id'];

if ( !empty($_POST)) { // if user clicks "yes" (sure to delete), delete record

	$id = $_POST['id'];
	
	// delete data
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM mc_teams WHERE id = ? AND user = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id,$_SESSION['session_id']));
	Database::disconnect();
	header("Location: mc_teams.php");
} 
else { // otherwise, pre-populate fields to show data to be deleted

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	# get team details
	$sql = "SELECT * FROM mc_teams where id = ?";
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
				<h3>Delete Team</h3>
			</div>
			
			<form class="form-horizontal" action="mc_team_delete.php" method="post">
				<input type="hidden" name="id" value="<?php echo $id;?>"/>
				<p class="alert alert-error">Are you sure you want to delete ?</p>
				<div class="form-actions">
					<button type="submit" class="btn btn-danger">Yes</button>
					<a class="btn" href="mc_teams.php">No</a>
				</div>
			</form>
			
			<!-- Display same information as in file: fr_assign_read.php -->
			
			<div class="form-horizontal" >
			
				<div class="control-group">
					<label class="control-label">Team Name</label>
					<div class="controls">
						<label class="checkbox">
							<?php echo $data['team_name']  ;?>
						</label>
					</div>
				</div>
				
			
			</div> <!-- end div: class="form-horizontal" -->
			
		</div> <!-- end div: class="span10 offset1" -->
		
    </div> <!-- end div: class="container" -->
	
</body>
</html>