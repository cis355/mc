<?php 
// ------------------------------------------------
// MAIN PROCESSING
// ------------------------------------------------
define("PRO",1);
define("CON",2);
define("NOT-SET",0);
include '../database/database.php';
$teamcount = 0;
$teams = array();
$sql = "SELECT * FROM mc_teams ORDER BY id";
compute_rounds();
$hashTimes = 50;
for($i=0; $i<$hashTimes; $i++) {
	if(teamsHasZeros()) {
		$sql = "SELECT * FROM mc_teams ORDER BY " . md5string($i);
		compute_rounds();
	}
}

if(teamsHasZeros()) {
	echo "Error: not all teams were set."; 
	exit();
}

update_database();
header("Location: mc_teams.php");

// ***** END OF PROGRAM *****

// ------------------------------------------------
// FUNCTIONS
// ------------------------------------------------
function md5string ($n) {
	// using md5 randomizes the order of the rows in the $teams 2d array
	$s = "id";
	for($i=0; $i<$n; $i++) $s = "MD5(" . $s . ")";
	return " " . $s;
}

function teamsHasZeros () {
	global $teams;
	global $teamcount;
	$retval = false;
	for($i=0; $i < $teamcount; $i++) {
		if ((intval($teams[$i][3]) < 1) or (intval($teams[$i][6]) < 1) or (intval($teams[$i][9]) < 1)) { 
			$retval = true;
			break;
		}
	}
	return $retval;
}

function build_teams_array() {
	global $teams;
	global $teamcount;
	global $sql;
	$teams = array(); // clear the array
	// ------------------------------------------------
	// create array of teams
	// ------------------------------------------------
	//$sql = "SELECT * FROM mc_teams ORDER BY MD5(id)";
	$pdo = Database::connect();
	$teamcount = 0;
	$thisteam = 1;
	foreach ($pdo->query($sql) as $row) {
		$t = array(intval($row['id']), 
			$row['team_name'],
			intval($row['team_school']),
			intval($row['classroom1']),
			intval($row['side1']),
			intval($row['competitor1']),
			intval($row['classroom2']),
			intval($row['side2']),
			intval($row['competitor2']),
			intval($row['classroom3']),
			intval($row['side3']),
			intval($row['competitor3']),
			$thisteam++, 0, 0, 0 // for renumbering teams
		); 
		array_push($teams, $t);
		$teamcount++;
	}
	Database::disconnect();
}

function compute_rounds () {
	global $teams;
	global $teamcount;
	global $sql;
	build_teams_array();
	// ------------------------------------------------
	// assign teams for round 1
	// loop forward-forward (i++/j++) so low numbered teams get low numbered rooms
	// ------------------------------------------------
	$classroom = 1;
	for($i=0; $i < $teamcount; $i++) {
	//for($i=$teamcount-1; $i >=0 ; $i--) {

		for($j=0; $j < $teamcount; $j++) {
		//for($j=0; $j < $teamcount; $j++) {
			
			if($teams[$i][2] != $teams[$j][2] && // team cannot play same school
				$teams[$i][3] == 0 && // team is unassigned
				$teams[$j][3] == 0 ) {// team is unassigned
				
				// assign teams i and j to each other
				$teams[$i][3] = $classroom;
				$teams[$j][3] = $classroom;
				$classroom++;
				$teams[$i][4] = PRO; // assign first team PRO
				$teams[$j][4] = CON; // assign second team CON
				$teams[$i][5] = $teams[$j][0]; // id
				$teams[$j][5] = $teams[$i][0];
				$teams[$i][13] = $teams[$j][12]; // team_number
				$teams[$j][13] = $teams[$i][12];
				
				break;
			}
		}
	}

	// ------------------------------------------------
	// assign teams for round 2
	// loop backward-backward (i--/j--) so high numbered teams get low numbered rooms
	// ------------------------------------------------
	$classroom = 1;
	//for($i=0; $i < $teamcount; $i++) {
	for($i=$teamcount-1; $i >=0 ; $i--) {

		//for($j=0; $j < $teamcount; $j++) {
		for($j=$teamcount-1; $j >= 0; $j--) {
			
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
				if ($teams[$i][4] == PRO) { // if first team was PRO last time
					$teams[$i][7] = CON; // assign first team CON
					$teams[$j][7] = PRO; // assign second team PRO
				}
				else {
					$teams[$i][7] = PRO; // assign first team PRO
					$teams[$j][7] = CON; // assign second team CON
				}
				$teams[$i][8] = $teams[$j][0]; // id
				$teams[$j][8] = $teams[$i][0];
				$teams[$i][14] = $teams[$j][12]; // team_number
				$teams[$j][14] = $teams[$i][12];
				
				break;
			}
		}
	}
	
	// ------------------------------------------------
	// assign teams for round 3
	// loop backward-backward again (i--/j--)
	// but start classroom numbering at $teamcount / 2
	// so high numbered teams get middle-numbered rooms
	// ------------------------------------------------
	$classroom = 1;
	//$classroom = $teamcount / 2;
	//for($i=0; $i < $teamcount; $i++) {
	for($i=$teamcount-1; $i >=0 ; $i--) {

		//for($j=0; $j < $teamcount; $j++) {
		for($j=$teamcount-1; $j >= 0; $j--) {
		
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
				//if($classroom == $teamcount) $classroom = 1;
				//else $classroom++;
				$classroom++;
				$teams[$i][10] = CON; // assign first team CON
				$teams[$j][10] = PRO; // assign second team PRO
				$teams[$i][11] = $teams[$j][0]; // id
				$teams[$j][11] = $teams[$i][0];
				$teams[$i][15] = $teams[$j][12]; // team_number
				$teams[$j][15] = $teams[$i][12];
				
				break;
			}
		}
	}
} // end function: compute_rounds()

function print_results () {
	global $teams;
	global $teamcount;
	// ------------------------------------------------
	// print results
	// ------------------------------------------------

	echo "Round 1<br/><br/>";
	for($i=0; $i < $teamcount; $i++) {
		echo "team" . $teams[$i][0] . (PRO==$teams[$i][4] ? "/PRO" : "/CON") .  " plays team". $teams[$i][5] .  " in room" . ($teams[$i][3]) . "<br/>";
	}
	echo "<br />";

	echo "Round 2<br/><br/>";
	for($i=0; $i < $teamcount; $i++) {
		echo "team" . $teams[$i][0] . (PRO==$teams[$i][7] ? "/PRO" : "/CON") .  " plays team". $teams[$i][8] .  " in room" . ($teams[$i][6]) . "<br/>";
	}
	echo "<br />";

	echo "Round 3<br/><br/>";
	for($i=0; $i < $teamcount; $i++) {
		echo "team" . $teams[$i][0] . (PRO==$teams[$i][10] ? "/PRO" : "/CON") .  " plays team". $teams[$i][11] .  " in room" . ($teams[$i][9]) . "<br/>";
	}
	echo "<br />";

	echo '<a href="mc_teams.php" class="btn">Back</a>';
} // end function: print results


function update_database() {
	global $teams;
	global $teamcount;
	// ------------------------------------------------
	// update database with results
	// ------------------------------------------------
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	for($i=0; $i < $teamcount; $i++) {
		//$sql = "UPDATE mc_teams set classroom1 = ?, side1 = ?, competitor1 = ?, classroom2 = ?, side2 = ?, competitor2 = ?, classroom3 = ?, side3 = ?, competitor3 = ?, team_number = ?  WHERE id = ?";
		$sql = "UPDATE mc_teams set classroom1 = ?, side1 = ?, competitor1 = ?, classroom2 = ?, side2 = ?, competitor2 = ?, classroom3 = ?, side3 = ?, competitor3 = ?, team_number = ?, team_number1 = ?, team_number2 = ?, team_number3 = ?  WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($teams[$i][3],$teams[$i][4],$teams[$i][5],$teams[$i][6],$teams[$i][7],$teams[$i][8],$teams[$i][9],$teams[$i][10],$teams[$i][11], $teams[$i][12],$teams[$i][13],$teams[$i][14],$teams[$i][15], $teams[$i][0]));
	}
	Database::disconnect();
}

?>