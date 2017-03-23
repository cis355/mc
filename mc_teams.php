<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_teams.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays a list of moot court teams and
 *               their competitors for round1, round2 and round3
 * ---------------------------------------------------------------------------
 */

/*
session_start();
if(!isset($_SESSION["fr_person_id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');   // go to login page
	exit;
}

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
			<h3>Teams/Rounds</h3>
		</div>
		
		<!-- Display menu bar links: Create, Logout, Teams/Rounds, Schools, Classrooms -->

		<div class="row">
			<p>
				<a href="mc_team_create.php" class="btn btn-primary">Add Team</a>
				<a href="logout.php" class="btn btn-warning">Logout</a> &nbsp;&nbsp;&nbsp;
				<a href="mc_teams.php">Teams/Rounds</a> &nbsp;
				<a href="mc_schools.php">Schools</a> &nbsp;
				<a href="mc_classrooms.php">Classrooms</a> &nbsp;
				<a href="mc_compute_rounds.php" class="btn btn-primary">Compute Rounds</a>
			</p>
			
			<!-- Display html table list of teams and rounds -->
			
			<table class="table table-striped table-bordered" style="background-color: lightgrey !important">
				<thead>
					<tr>
						<th>Team</th>
						<th>School</th>
						<th>Round1</th>
						<th>Round2</th>
						<th>Round3</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					include '../database/database.php';
					$pdo = Database::connect();
					$sql = "SELECT * FROM mc_teams, mc_schools WHERE team_school = mc_schools.id ORDER BY team_name";

					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['team_name'] . ' (team' . $row[0] . ')' . '</td>';
						echo '<td>'. $row['school_name'] . '</td>';
						echo '<td>'. $row['classroom1'] . ' - ' . $row['side1'] . ' - ' . $row['competitor1'] . '</td>';
						echo '<td>'. $row['classroom2'] . ' - ' . $row['side2'] . ' - ' . $row['competitor2'] . '</td>';
						echo '<td>'. $row['classroom3'] . ' - ' . $row['side3'] . ' - ' . $row['competitor3'] . '</td>';

						echo '<td width=250>';
						// Read function not needed
						// echo '<a class="btn" href="mc_team_read.php?id='.$row[0].'">Read</a>';
						echo '<a class="btn btn-success" href="mc_team_update.php?id='.$row[0].'">Update</a>';
						echo '<a class="btn btn-danger" href="mc_team_delete.php?id='.$row[0].'">Delete</a>';

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