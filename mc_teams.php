<?php 
/* ---------------------------------------------------------------------------
 * filename    : mc_teams.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program displays a list of moot court teams and
 *               their competitors for round1, round2 and round3
 * ---------------------------------------------------------------------------
 */
define("Pet",1);
define("Resp",2);
define("NOT-SET",0);
include 'functions.php';
functions::requireSession();
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
		
		<?php functions::logoDisplay2(); ?>
		
		<!-- Display title of screen -->
		
		<div class="row">
			<h3>Teams/Rounds</h3>
		</div>
		
		<!-- Display menu bar links: Create, Logout, Teams/Rounds, Schools, Classrooms -->

		<div class="row">
			<p>
				<a href="mc_team_create.php" class="btn btn-primary">Add New Team</a>
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
						<th>No</th>
						<th>Team Name</th>
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
					$sql = "SELECT * FROM mc_teams, mc_schools WHERE team_school = mc_schools.id AND  mc_schools.user = ".$_SESSION['session_id']." ORDER BY mc_teams.team_number";

					foreach ($pdo->query($sql) as $row) {

						echo '<tr>';
						//echo '<td>' . $row[0] .'</td>';
						echo '<td>' . $row['team_number'] .'</td>';
						echo '<td>' . $row['team_name'] .'</td>';
						echo '<td>' . $row['school_name'] .'</td>';
						
						// round1
						if ($row['side1']!=0) echo '<td>room'. $row['classroom1'] . ' - ' . (Pet==$row['side1'] ? "Pet" : "Resp") . ' - x:' . $row['team_number1'] . '</td>';
						else echo '<td>room'. $row['classroom1'] . ' - ' . 'NOT-SET' . ' - x:' . $row['team_number1'] . '</td>';
						
						// round2
						if ($row['side2']!=0) echo '<td>room'. $row['classroom2'] . ' - ' . (Pet==$row['side2'] ? "Pet" : "Resp") . ' - x:' . $row['team_number2'] . '</td>';
						else echo '<td>room'. $row['classroom2'] . ' - ' . 'NOT-SET' . ' - x:' . $row['team_number2'] . '</td>';
						
						// round 3: list side3 as "FLIP"
						if ($row['side3']!=0) echo '<td>room'. $row['classroom3'] . ' - ' . 'FLIP' . ' - x:' . $row['team_number3'] . '</td>';
						else echo '<td>room'. $row['classroom3'] . ' - ' . 'NOT-SET' . ' - x:' . $row['team_number3'] . '</td>';

						echo '<td>';
						// Read function not needed. All info appears in menu list.
						// echo '<a class="btn" href="mc_team_read.php?id='.$row[0].'">Read</a>';
						echo '<a class="btn btn-success" href="mc_team_update.php?id='.$row[0].'">Update</a>';
						echo '<a class="btn btn-danger" href="mc_team_delete.php?id='.$row[0].'">Delete</a>';

						echo '</td>';
						echo '</tr>';

					} // end: foreach

					Database::disconnect();
				?>
				</tbody>
				
			</table>
			<p>* Note: If you see a zero (0) in the first column, then you must click "compute rounds" to renumber the teams.</p>
    	</div>

    </div> <!-- end div: class="container" -->
	
</body>
</html>