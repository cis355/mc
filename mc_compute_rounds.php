<?php 
define("PRO",1);
define("CON",2);
include '../database/database.php';

// ------------------------------------------------
// create an array of teams
$pdo = Database::connect();
$sql = "SELECT * FROM mc_teams";
$teams = array();
$teamcount = 0;
foreach ($pdo->query($sql) as $row) {
	$t = array($row['id'], 
		$row['team_name'],
		$row['team_school'],
		$row['classroom1'],
		$row['side1'],
		$row['competitor1'],
		$row['classroom2'],
		$row['side2'],
		$row['competitor2'],
		$row['classroom3'],
		$row['side3'],
		$row['competitor3'],
	); 
	array_push($teams, $t);
	$teamcount++;
}
Database::disconnect();

// ------------------------------------------------
// assign teams for round 1
$classroom = 1;
for($i=0; $i < $teamcount; $i++) {

	for($j=0; $j < $teamcount; $j++) {
		
		if($teams[$i][2] != $teams[$j][2] && // team cannot play same school
			$teams[$i][3] == 0 && // team is unassigned
			$teams[$j][3] == 0 ) {// team is unassigned
			
			// assign teams i and j to each other
			$teams[$i][3] = $classroom;
			$teams[$j][3] = $classroom;
			$classroom++;
			$teams[$i][4] = PRO; // assign first team PRO
			$teams[$j][4] = CON; // assign second team CON
			$teams[$i][5] = $teams[$j][0];
			$teams[$j][5] = $teams[$i][0];
			
			break;
		}
	}
}

// ------------------------------------------------
// assign teams for round 2
$classroom = 1;
for($i=$teamcount-1; $i >=0 ; $i--) {
//for($i=0; $i < $teamcount; $i++) {
	for($j=0; $j < $teamcount; $j++) {
		
		if($teams[$i][2] != $teams[$j][2] && // team cannot play same school 
			// teams cannot have been same PRO/CON side last time
			$teams[$i][4] != $teams[$j][4] &&
			// teams cannot have played each other in round 1
			$teams[$i][5] != $teams[$j][0] &&
			$teams[$j][5] != $teams[$i][0] &&
			// teams cannot have played in current classroom in round 1
			$teams[$i][3] != $classroom &&
			$teams[$j][3] != $classroom &&
			$teams[$i][6] == 0 && // team is unassigned for round2
			$teams[$j][6] == 0 ) {// team is unassigned for round2
			
			// assign teams i and j to each other
			$teams[$i][6] = $classroom;
			$teams[$j][6] = $classroom;
			$classroom++;
			if ($teams[$i][4]==PRO) { // if first team was PRO last time
				$teams[$i][7] = CON; // assign first team CON
				$teams[$j][7] = PRO; // assign second team PRO
			}
			else {
				$teams[$i][7] = PRO; // assign first team PRO
				$teams[$j][7] = CON; // assign second team CON
			}
			$teams[$i][8] = $teams[$j][0];
			$teams[$j][8] = $teams[$i][0];
			
			break;
		}
	}
}


// ------------------------------------------------
// assign teams for round 3
$classroom = 1;

for($i=$teamcount-1; $i >=0 ; $i--) {
//for($i=0; $i < $teamcount; $i++) {

	for($j=$teamcount-1; $j >= 0; $j--) {
	//for($j=0; $j < $teamcount; $j++) {
	
		if($teams[$i][2] != $teams[$j][2] && // team cannot play same school 
			// teams cannot have been same PRO/CON side last time
			// $teams[$i][4] != $teams[$j][4] &&  // irrelevant in round 3
			// teams cannot have played each other in round 1
			$teams[$i][5] != $teams[$j][0] &&
			$teams[$j][5] != $teams[$i][0] &&
			// teams cannot have played each other in round 2
			$teams[$i][8] != $teams[$j][0] &&
			$teams[$j][8] != $teams[$i][0] &&
			// teams cannot have played in current classroom in round 1
			$teams[$i][3] != $classroom &&
			$teams[$j][3] != $classroom &&
			// teams cannot have played in current classroom in round 2
			$teams[$i][6] != $classroom &&
			$teams[$j][6] != $classroom &&
			$teams[$i][9] == 0 && // team is unassigned for round 3
			$teams[$j][9] == 0 ) {// team is unassigned for round 3
			
			// assign teams i and j to each other
			$teams[$i][9] = $classroom;
			$teams[$j][9] = $classroom;
			$classroom++;
			$teams[$i][10] = CON; // assign first team CON
			$teams[$j][10] = PRO; // assign second team PRO
			$teams[$i][11] = $teams[$j][0];
			$teams[$j][11] = $teams[$i][0];
			
			break;
		}
	}
}

// ------------------------------------------------
// print results
for($i=0; $i < $teamcount; $i++) {
	echo "team" . $teams[$i][0] .  " ... ROOM" . (100+$teams[$i][3]) . "-" . (PRO==$teams[$i][4] ? "PRO" : "CON") . "-x:team" . $teams[$i][5] .  " ... ROOM" . (100+$teams[$i][6]) . "-" . (PRO==$teams[$i][7] ? "PRO" : "CON") . "-x:team" . $teams[$i][8] ." ... ROOM" . (100+$teams[$i][9]) . "-" . (PRO==$teams[$i][10] ? "PRO" : "CON") . "-x:team" . $teams[$i][11] . "<br/>";
}
echo "<br />";

echo '<a href="mc_teams.php" class="btn">Back</a>';


?>