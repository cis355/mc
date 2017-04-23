<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_schools.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays a list of schools
 * ---------------------------------------------------------------------------
 */
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
	
		<!-- display logo at top of screen -->
		
		<?php 
			include 'functions.php';
			functions::logoDisplay2();
		?>
		
		<!-- Display title of screen -->
		
		<div class="row">
			<h3>Schools</h3>
		</div>
		
		<!-- Display menu bar links: Create, Logout, Teams/Rounds, Schools, Classrooms -->

		<div class="row">
			<p>
				<a href="mc_school_create.php" class="btn btn-primary">Add New School</a>
				<a href="logout.php" class="btn btn-warning">Logout</a> &nbsp;&nbsp;&nbsp;
				<a href="mc_teams.php">TeamsList</a> &nbsp;
				<a href="mc_schools.php">SchoolsList</a> &nbsp;
				<a href="mc_compute_rounds.php" class="btn btn-primary">Compute Rounds</a>
				<a href="mc_clear_rounds.php" class="btn btn-danger">Clear Rounds</a>
			</p>
			
			<!-- Display html table list of teams and rounds -->
			
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>School</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include '../database/database.php';
					$pdo = Database::connect();
					//$sql = "SELECT * FROM mc_schools ORDER BY school_name ASC";
					// do not allow delete if countTeams > 0
					$sql = 'SELECT `mc_schools`.*, COUNT(`mc_teams`.`team_name`) AS countTeams FROM `mc_schools` LEFT OUTER JOIN `mc_teams` ON (`mc_schools`.`id`=`mc_teams`.`team_school`) GROUP BY `mc_schools`.`id` ORDER BY `mc_schools`.`school_name` ASC';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['school_name'] . '</td>';
						echo '<td width=250>';
						// Read function not needed
						// echo '<a class="btn" href="mc_school_read.php?id='.$row[0].'">Read</a>';
						echo '<a class="btn btn-success" href="mc_school_update.php?id='.$row[0].'">Update</a>';
						// delete not allowed if teams exist for school
						if ($row['countTeams'] == 0) echo '<a class="btn btn-danger" href="mc_school_delete.php?id='.$row[0].'">Delete</a>';
						echo '</td>';
						echo '</tr>';
					}
					Database::disconnect();
				?>
				</tbody>
			</table>
    	</div>

    </div> <!-- end div: class="container" -->
	
</body>
</html>